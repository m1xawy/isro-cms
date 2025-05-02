<?php

namespace App\Http\Controllers;

use App\Models\SRO\Log\LogChatMessage;
use App\Models\SRO\Log\LogInstanceWorldInfo;
use App\Models\SRO\Shard\Char;
use App\Models\SRO\Shard\CharSkillMastery;
use App\Models\SRO\Shard\CharTradeConflictJob;
use App\Models\SRO\Shard\CharTrijob;
use App\Models\SRO\Shard\Guild;
use App\Models\SRO\Shard\GuildMember;
use App\Models\SRO\Shard\TrainingCampHonorRank;
use App\Services\CrestService;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('type') == 'player' && $request->filled('search')) {
            $data = Char::getPlayerRanking(25, 0, $request->search);
        }elseif ($request->input('type') == 'guild' && $request->filled('search')) {
            $data = Guild::getGuildRanking(25, 0, $request->search);
        }else {
            $data = Char::getPlayerRanking();
        }

        return view('ranking.index', ['data' => $data, 'type' => $request->input('type')]);
    }

    public function player()
    {
        $data = Char::getPlayerRanking();
        return view('ranking.ranking.player', compact('data'));
    }

    public function guild()
    {
        $data = Guild::getGuildRanking();
        return view('ranking.ranking.guild', compact('data'));
    }

    public function unique()
    {
        $data = LogInstanceWorldInfo::getUniqueRanking();
        $unique_points = config('global.ranking.unique_points');
        return view('ranking.ranking.unique', [
            'data' => $data,
            'unique_points' => $unique_points,
        ]);
    }

    public function unique_monthly()
    {
        $data = LogInstanceWorldInfo::getUniqueRanking(25, 1);
        $unique_points = config('global.ranking.unique_points');
        return view('ranking.ranking.unique-monthly', [
            'data' => $data,
            'unique_points' => $unique_points,
        ]);
    }

    public function fortress_player()
    {
        $data = GuildMember::getFortressPlayerRanking();
        return view('ranking.ranking.fortress-player', compact('data'));
    }

    public function fortress_guild()
    {
        $data = Guild::getFortressGuildRanking();
        return view('ranking.ranking.fortress-guild', compact('data'));
    }

    public function honor()
    {
        $data = TrainingCampHonorRank::getHonorRanking();
        return view('ranking.ranking.honor', compact('data'));
    }

    public function job()
    {
        $data = CharTrijob::getJobRanking();
        return view('ranking.ranking.job', compact('data'));
    }

    public function job_all()
    {
        $data = CharTrijob::getJobRanking();
        return view('ranking.ranking.job-all', compact('data'));
    }

    public function job_hunter()
    {
        $data = CharTrijob::getJobRanking(25, 1);
        return view('ranking.ranking.job-hunter', compact('data'));
    }

    public function job_thieve()
    {
        $data = CharTrijob::getJobRanking(25, 2);
        return view('ranking.ranking.job-thieve', compact('data'));
    }

    public function job_trader()
    {
        $data = CharTrijob::getJobRanking(25, 3);
        return view('ranking.ranking.job-trader', compact('data'));
    }

    public function character_view($name, InventoryService $inventoryService)
    {
        $charID = Char::getCharIDByName($name);
        if ($charID > 0) {
            $data = Char::getPlayerRanking(1, $charID)->first();
            $unique_history = LogInstanceWorldInfo::getUniquesKill(5, $charID);
            $globals_history = LogChatMessage::getGlobalsHistory(5, $name);
            $build_info = CharSkillMastery::getCharBuildInfo($charID);

            $inventory_set = $inventoryService->getInventorySet($charID, 13, 0);
            $inventory_avatar = $inventoryService->getInventoryAvatar($charID);

            if ($data) {
                return view('ranking.character.index', [
                    'data' => $data,
                    'unique_history' => $unique_history,
                    'globals_history' => $globals_history,
                    'build_info' => $build_info,
                    'inventory_set' => $inventory_set,
                    'inventory_avatar' => $inventory_avatar
                ]);
            }
        }
        return redirect()->back();
    }

    public function guild_view($name)
    {
        $guildID = Guild::getGuildIDByName($name);
        if ($guildID > 0) {

            $data = Guild::getGuildRanking(1, $guildID)->first();
            $data_members = GuildMember::getGuildInfoMembers($guildID);
            $data_alliances = Guild::getGuildInfoAlliance($guildID);

            if ($data) {
                return view('ranking.guild.index', [
                    'data' => $data,
                    'data_members' => $data_members,
                    'data_alliances' => $data_alliances,
                ]);
            }
        }

        return redirect()->back();
    }

    public function guild_crest($hex, CrestService $guildService)
    {
        if ($hex) return $guildService->drawGuildIconToPNG($hex);

        abort(404);
    }
}
