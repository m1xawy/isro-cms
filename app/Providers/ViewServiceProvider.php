<?php

namespace App\Providers;

use App\Models\Pages;
use App\Models\SRO\Account\ShardCurrentUser;
use App\Models\SRO\Log\LogChatMessage;
use App\Models\SRO\Log\LogEventChar;
use App\Models\SRO\Log\LogEventItem;
use App\Models\SRO\Log\LogInstanceWorldInfo;
use App\Models\SRO\Shard\Char;
use App\Models\SRO\Shard\Guild;
use App\Models\SRO\Shard\SiegeFortress;
use App\Services\ScheduleService;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            View::composer('layouts.header', function ($view) {
                $view->with('pages', Pages::getPageNames());
            });

            View::composer(['*'], function ($view) {
                $view->with([
                    'onlineCounter' => (object) [
                        'onlinePlayer' => ShardCurrentUser::getOnlineCounter(),
                        'maxPlayer' => config('global.max_player', 1000),
                        'fakePlayer' => config('global.fake_player', 0)
                    ]
                ]);
            });

            if(config('widgets.event_schedule.enabled', false)) {
                View::composer(['partials.event-schedule'], function ($view) {
                    $view->with([
                        'eventSchedule' => ScheduleService::getEventSchedules(),
                    ]);
                });
            }

            if(config('widgets.fortress_war.enabled', false)) {
                View::composer(['partials.fortress-war'], function ($view) {
                    $view->with([
                        'fortressWar' => SiegeFortress::getFortressWar(),
                    ]);
                });
            }

            if(config('widgets.global_history.enabled', false)) {
                View::composer(['partials.global-history'], function ($view) {
                    $view->with([
                        'globalsHistory' => LogChatMessage::getGlobalsHistory(config('widgets.global_history.limit', 5)),
                    ]);
                });
            }

            if(config('widgets.unique_history.enabled', false)) {
                View::composer(['partials.unique-history'], function ($view) {
                    $view->with([
                        'uniqueHistory' => LogInstanceWorldInfo::getUniquesKill(config('widgets.unique_history.limit', 5)),
                    ]);
                });
            }

            if(config('widgets.top_player.enabled', false)) {
                View::composer(['partials.top-player'], function ($view) {
                    $view->with([
                        'topPlayer' => Char::getPlayerRanking(config('widgets.top_player.limit', 5)),
                    ]);
                });
            }

            if(config('widgets.top_guild.enabled', false)) {
                View::composer(['partials.top-guild'], function ($view) {
                    $view->with([
                        'topGuild' => Guild::getGuildRanking(config('widgets.top_guild.limit', 5)),
                    ]);
                });
            }

            if(config('widgets.item_plus.enabled', false)) {
                View::composer(['partials.item-plus'], function ($view) {
                    $view->with([
                        'soxPlus' => LogEventItem::getLogEventItem('plus', 8, 8, 'Seal of Sun', null, config('widgets.item_plus.limit', 5)),
                    ]);
                });
            }

            if(config('widgets.item_drop.enabled', false)) {
                View::composer(['partials.item-drop'], function ($view) {
                    $view->with([
                        'soxDrop' => LogEventItem::getLogEventItem('drop', null, 8, 'Seal of Sun', null, config('widgets.item_drop.limit', 5)),
                    ]);
                });
            }

            if(config('widgets.pvp_kill.enabled', false)) {
                View::composer(['partials.pvp-kill'], function ($view) {
                    $view->with([
                        'pvpKills' => LogEventChar::getKillLogs('pvp', config('widgets.pvp_kill.limit', 5)),
                    ]);
                });
            }

            if(config('widgets.job_kill.enabled', false)) {
                View::composer(['partials.job-kill'], function ($view) {
                    $view->with([
                        'jobKills' => LogEventChar::getKillLogs('job', config('widgets.job_kill.limit', 5)),
                    ]);
                });
            }

            $widgetsConfig = config('widgets.custom', []);
            foreach ($widgetsConfig as $key => $widget) {
                if (!($widget['enabled'] ?? false)) {
                    continue;
                }

                View::composer($widget['template'], function ($view) use ($widget, $key) {
                    $params = $view->getData();
                    preg_match_all('/:([a-zA-Z_]+)/', $widget['query'], $matches);
                    $queryParams = array_unique($matches[1]);

                    $sqlParams = [];
                    foreach ($queryParams as $param) {
                        $sqlParams[$param] = $params[$param] ?? null;
                    }

                    $cacheKey = 'widget_' . $key . '_' . md5(json_encode($sqlParams));
                    $data = Cache::remember($cacheKey, 600, function () use ($widget, $sqlParams) {
                        return collect(
                            DB::connection('shard')->select(
                                $widget['query'],
                                $sqlParams
                            )
                        );
                    });

                    $view->with([
                        'key' => $key,
                        'config' => $widget,
                        'data' => $data,
                        'params' => $params,
                    ]);
                });
            }

        } catch (QueryException $e) {
            // Error: Something Wrong.
        }
    }
}
