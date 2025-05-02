<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\News;
use App\Models\Pages;
use App\Models\SRO\Log\LogChatMessage;
use App\Models\SRO\Log\LogEventSiegeFortress;
use App\Models\SRO\Log\LogInstanceWorldInfo;
use App\Services\ScheduleService;

class PageController extends Controller
{
    public function index()
    {
        $data = News::getPosts();
        return view('pages.index', compact('data'));
    }

    public function post($slug)
    {
        $data = News::getPost($slug);
        if (!$data) {
            return redirect()->back();
        }

        return view('pages.view', compact('data'));
    }

    public function page($slug)
    {
        $data = Pages::getPage($slug);
        return view('pages.page', compact('data'));
    }

    public function download()
    {
        $data = Download::getDownloads();
        return view('pages.download', compact('data'));
    }

    public function timers(ScheduleService $scheduleService)
    {
        $data = $scheduleService->getEventSchedules();
        return view('pages.timers', compact('data'));
    }

    public function uniques()
    {
        $data = LogInstanceWorldInfo::getUniquesKill();
        return view('pages.uniques', compact('data'));
    }

    public function uniques_advanced()
    {
        $unique_kill = LogInstanceWorldInfo::getUniquesKill(9999, 0);
        $unique_ranking = LogInstanceWorldInfo::getUniqueRanking(9999, 0);
        $unique_list = config('global.ranking.unique_points');

        $data = [];
        foreach ($unique_kill as $value) {
            $data[$value->Value][] = $value;
        }

        return view('pages.uniques-advanced', [
            'data' => $data,
            'unique_ranking' => $unique_ranking,
            'unique_list' => $unique_list,
        ]);
    }

    public function fortress()
    {
        $data = LogEventSiegeFortress::getFortressHistory(25);
        return view('pages.fortress', compact('data'));
    }

    public function globals()
    {
        $data = LogChatMessage::getGlobalsHistory(25);
        return view('pages.globals', compact('data'));
    }
}
