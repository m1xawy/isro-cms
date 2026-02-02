<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vote;
use App\Models\Donate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SRO\Account\SkSilk;
use Illuminate\Support\Facades\Log;
use App\Models\SRO\Portal\AphChangedSilk;
use Vote4Rewards\Pingback\CallbackHandler;
use Vote4Rewards\Pingback\CallbackVerifier;

class VoteService
{
    public function postbackXtremetop100(Request $request)
    {
        $config = config("vote.xtremetop100");
        $remoteIp = $request->server('HTTP_CF_CONNECTING_IP') ?? $request->ip();

        $allowedIps = array_map('trim', explode(',', $config['ip']));
        if (!in_array($remoteIp, $allowedIps, true)) {
            Log::warning("Unauthorized {$config['name']} postback", ['ip' => $remoteIp]);
            return response("Unauthorized IP: {$remoteIp}", 401);
        }

        $jid = $request->input('custom');
        if (!$jid) {
            return response('Missing user ID', 400);
        }

        $user = User::where('jid', (int)$jid)->first();
        if (!$user) {
            return response('User not found', 200);
        }

        $now = Carbon::now();
        $timeout = $config['timeout'] ?? 12;
        $rewardAmount = $config['reward'] ?? 0;

        $voteLog = Vote::where('jid', $jid)->where('site', $config['route'])->first();
        if ($voteLog && $voteLog->expire && $now->lessThan(Carbon::parse($voteLog->expire))) {
            return response("Cooldown active until {$voteLog->expire}", 200);
        }

        if (config('global.server.version') === 'vSRO') {
            SkSilk::setSkSilk($user->jid, 0, $rewardAmount);
        } else {
            AphChangedSilk::setChangedSilk($user->jid, 3, $rewardAmount);
        }

        Donate::DonateLog([
            'method' => "Vote [{$config['name']}]",
            'value' => $rewardAmount,
            'jid' => $user->jid,
        ]);

        Vote::updateOrCreate(['jid' => $jid, 'site' => $config['route']], ['ip' => $remoteIp, 'expire' => $now->addHours($timeout)]);

        return response("OK", 200);
    }

    public function postbackGtop100(Request $request)
    {
        $config = config("vote.gtop100");
        $remoteIp = $request->server('HTTP_CF_CONNECTING_IP') ?? $request->ip();

        $allowedIps = array_map('trim', explode(',', $config['ip']));
        if (!in_array($remoteIp, $allowedIps, true)) {
            Log::warning("Unauthorized {$config['name']} postback", ['ip' => $remoteIp]);
            return response("Unauthorized IP: {$remoteIp}", 401);
        }

        $jid = $request->input('pingUsername');
        if (!$jid) {
            return response('Missing user ID', 400);
        }

        if ((int)$request->input('Successful') == 1) {
            return response($request->input('Reason') ?? 'Vote not successful', 200);
        }

        $user = User::where('jid', (int)$jid)->first();
        if (!$user) {
            return response('User not found', 200);
        }

        $now = Carbon::now();
        $timeout = $config['timeout'] ?? 12;
        $rewardAmount = $config['reward'] ?? 0;

        $voteLog = Vote::where('jid', $jid)->where('site', $config['route'])->first();
        if ($voteLog && $voteLog->expire && $now->lessThan(Carbon::parse($voteLog->expire))) {
            return response("Cooldown active until {$voteLog->expire}", 200);
        }

        if (config('global.server.version') === 'vSRO') {
            SkSilk::setSkSilk($user->jid, 0, $rewardAmount);
        } else {
            AphChangedSilk::setChangedSilk($user->jid, 3, $rewardAmount);
        }

        Donate::DonateLog([
            'method' => "Vote [{$config['name']}]",
            'value' => $rewardAmount,
            'jid' => $user->jid,
        ]);

        Vote::updateOrCreate(['jid' => $jid, 'site' => $config['route']], ['ip' => $remoteIp, 'expire' => $now->addHours($timeout)]);

        return response("OK", 200);
    }

    public function postbackTopg(Request $request)
    {
        $config = config("vote.topg");
        $remoteIp = $request->server('HTTP_CF_CONNECTING_IP') ?? $request->ip();

        $allowedIps = array_map('trim', explode(',', $config['ip']));
        if (!in_array($remoteIp, $allowedIps, true)) {
            Log::warning("Unauthorized {$config['name']} postback", ['ip' => $remoteIp]);
            return response("Unauthorized IP: {$remoteIp}", 401);
        }

        $jid = $request->input('p_resp');
        if (!$jid) {
            return response('Missing user ID', 400);
        }

        $user = User::where('jid', (int)$jid)->first();
        if (!$user) {
            return response('User not found', 200);
        }

        $now = Carbon::now();
        $timeout = $config['timeout'] ?? 12;
        $rewardAmount = $config['reward'] ?? 0;

        $voteLog = Vote::where('jid', $jid)->where('site', $config['route'])->first();
        if ($voteLog && $voteLog->expire && $now->lessThan(Carbon::parse($voteLog->expire))) {
            return response("Cooldown active until {$voteLog->expire}", 200);
        }

        if (config('global.server.version') === 'vSRO') {
            SkSilk::setSkSilk($user->jid, 0, $rewardAmount);
        } else {
            AphChangedSilk::setChangedSilk($user->jid, 3, $rewardAmount);
        }

        Donate::DonateLog([
            'method' => "Vote [{$config['name']}]",
            'value' => $rewardAmount,
            'jid' => $user->jid,
        ]);

        Vote::updateOrCreate(['jid' => $jid, 'site' => $config['route']], ['ip' => $remoteIp, 'expire' => $now->addHours($timeout)]);

        return response("OK", 200);
    }

    public function postbackTop100arena(Request $request)
    {
        $config = config("vote.top100arena");
        $remoteIp = $request->server('HTTP_CF_CONNECTING_IP') ?? $request->ip();

        $allowedIps = array_map('trim', explode(',', $config['ip']));
        if (!in_array($remoteIp, $allowedIps, true)) {
            Log::warning("Unauthorized {$config['name']} postback", ['ip' => $remoteIp]);
            return response("Unauthorized IP: {$remoteIp}", 401);
        }

        $jid = $request->input('postback');
        if (!$jid) {
            return response('Missing user ID', 400);
        }

        $user = User::where('jid', (int)$jid)->first();
        if (!$user) {
            return response('User not found', 200);
        }

        $now = Carbon::now();
        $timeout = $config['timeout'] ?? 12;
        $rewardAmount = $config['reward'] ?? 0;

        $voteLog = Vote::where('jid', $jid)->where('site', $config['route'])->first();
        if ($voteLog && $voteLog->expire && $now->lessThan(Carbon::parse($voteLog->expire))) {
            return response("Cooldown active until {$voteLog->expire}", 200);
        }

        if (config('global.server.version') === 'vSRO') {
            SkSilk::setSkSilk($user->jid, 0, $rewardAmount);
        } else {
            AphChangedSilk::setChangedSilk($user->jid, 3, $rewardAmount);
        }

        Donate::DonateLog([
            'method' => "Vote [{$config['name']}]",
            'value' => $rewardAmount,
            'jid' => $user->jid,
        ]);

        Vote::updateOrCreate(['jid' => $jid, 'site' => $config['route']], ['ip' => $remoteIp, 'expire' => $now->addHours($timeout)]);

        return response("OK", 200);
    }

    public function postbackArenatop100(Request $request)
    {
        $config = config("vote.arenatop100");
        $remoteIp = $request->server('HTTP_CF_CONNECTING_IP') ?? $request->ip();

        $allowedIps = array_map('trim', explode(',', $config['ip']));
        if (!in_array($remoteIp, $allowedIps, true)) {
            Log::warning("Unauthorized {$config['name']} postback", ['ip' => $remoteIp]);
            return response("Unauthorized IP: {$remoteIp}", 401);
        }

        $jid = $request->input('userid');
        if (!$jid) {
            return response('Missing user ID', 400);
        }

        if ((int)$request->input('voted') !== 1) {
            return response("User $jid voted already today!", 200);
        }

        $user = User::where('jid', (int)$jid)->first();
        if (!$user) {
            return response('User not found', 200);
        }

        $now = Carbon::now();
        $timeout = $config['timeout'] ?? 12;
        $rewardAmount = $config['reward'] ?? 0;

        $voteLog = Vote::where('jid', $jid)->where('site', $config['route'])->first();
        if ($voteLog && $voteLog->expire && $now->lessThan(Carbon::parse($voteLog->expire))) {
            return response("Cooldown active until {$voteLog->expire}", 200);
        }

        if (config('global.server.version') === 'vSRO') {
            SkSilk::setSkSilk($user->jid, 0, $rewardAmount);
        } else {
            AphChangedSilk::setChangedSilk($user->jid, 3, $rewardAmount);
        }

        Donate::DonateLog([
            'method' => "Vote [{$config['name']}]",
            'value' => $rewardAmount,
            'jid' => $user->jid,
        ]);

        Vote::updateOrCreate(['jid' => $jid, 'site' => $config['route']], ['ip' => $remoteIp, 'expire' => $now->addHours($timeout)]);

        return response("OK", 200);
    }

    public function postbackSilkroadservers(Request $request)
    {
        $config = config("vote.silkroadservers");
        $remoteIp = $request->server('HTTP_CF_CONNECTING_IP') ?? $request->ip();

        $allowedIps = array_map('trim', explode(',', $config['ip']));
        if (!in_array($remoteIp, $allowedIps, true)) {
            Log::warning("Unauthorized {$config['name']} postback", ['ip' => $remoteIp]);
            return response("Unauthorized IP: {$remoteIp}", 401);
        }

        $jid = $request->input('userid');
        if (!$jid) {
            return response('Missing user ID', 400);
        }

        $user = User::where('jid', (int)$jid)->first();
        if (!$user) {
            return response('User not found', 200);
        }

        $now = Carbon::now();
        $timeout = $config['timeout'] ?? 12;
        $rewardAmount = $config['reward'] ?? 0;

        $voteLog = Vote::where('jid', $jid)->where('site', $config['route'])->first();
        if ($voteLog && $voteLog->expire && $now->lessThan(Carbon::parse($voteLog->expire))) {
            return response("Cooldown active until {$voteLog->expire}", 200);
        }

        if (config('global.server.version') === 'vSRO') {
            SkSilk::setSkSilk($user->jid, 0, $rewardAmount);
        } else {
            AphChangedSilk::setChangedSilk($user->jid, 3, $rewardAmount);
        }

        Donate::DonateLog([
            'method' => "Vote [{$config['name']}]",
            'value' => $rewardAmount,
            'jid' => $user->jid,
        ]);

        Vote::updateOrCreate(['jid' => $jid, 'site' => $config['route']], ['ip' => $remoteIp, 'expire' => $now->addHours($timeout)]);

        return response("OK", 200);
    }

    public function postbackPrivateserver(Request $request)
    {
        $config = config("vote.privateserver");
        $remoteIp = $request->server('HTTP_CF_CONNECTING_IP') ?? $request->ip();

        $allowedIps = array_map('trim', explode(',', $config['ip']));
        if (!in_array($remoteIp, $allowedIps, true)) {
            Log::warning("Unauthorized {$config['name']} postback", ['ip' => $remoteIp]);
            return response("Unauthorized IP: {$remoteIp}", 401);
        }

        $jid = $request->input('userid');
        if (!$jid) {
            return response('Missing user ID', 400);
        }

        $user = User::where('jid', (int)$jid)->first();
        if (!$user) {
            return response('User not found', 200);
        }

        $now = Carbon::now();
        $timeout = $config['timeout'] ?? 12;
        $rewardAmount = $config['reward'] ?? 0;

        $voteLog = Vote::where('jid', $jid)->where('site', $config['route'])->first();
        if ($voteLog && $voteLog->expire && $now->lessThan(Carbon::parse($voteLog->expire))) {
            return response("Cooldown active until {$voteLog->expire}", 200);
        }

        if (config('global.server.version') === 'vSRO') {
            SkSilk::setSkSilk($user->jid, 0, $rewardAmount);
        } else {
            AphChangedSilk::setChangedSilk($user->jid, 3, $rewardAmount);
        }

        Donate::DonateLog([
            'method' => "Vote [{$config['name']}]",
            'value' => $rewardAmount,
            'jid' => $user->jid,
        ]);

        Vote::updateOrCreate(['jid' => $jid, 'site' => $config['route']], ['ip' => $remoteIp, 'expire' => $now->addHours($timeout)]);

        return response("OK", 200);
    }


    /**
     * Handle Vote4Rewards postback
     *
     * @param Request $request
     * @return void
     */
    public function postbackVote4rewards(Request $request)
    {
        $config = config("vote.vote4rewards");
        $remoteIp = $request->server('HTTP_CF_CONNECTING_IP') ?? $request->ip();

        $allowedIps = array_map('trim', explode(',', $config['ip']));
        if (!in_array($remoteIp, $allowedIps, true)) {
            Log::warning("Unauthorized {$config['name']} postback", ['ip' => $remoteIp]);
            return response("Unauthorized IP: {$remoteIp}", 401);
        }

        $handler = new CallbackHandler();
        $verifier = new CallbackVerifier();

        $handler->onVerify(function (array $data, string $ip) use ($verifier) {
            return $verifier->verify($data, $ip);
        });

        // Define what happens when a reward is received
        $handler->onReward(function (array $data) use ($config, $remoteIp) {
            // Extract player username and server info
            $username = $data['voter_id'];
            $serverId = $data['server_uuid'];

            $user = User::where('jid', (int)$username)->first();
            if (!$user) {
                return response('User not found', 200);
            }

            $now = Carbon::now();
            $timeout = $config['timeout'] ?? 6;
            $rewardAmount = $config['reward'] ?? 0;

            // Give reward to player
            if (config('global.server.version') === 'vSRO') {
                SkSilk::setSkSilk($user->jid, 0, $rewardAmount);
            } else {
                AphChangedSilk::setChangedSilk($user->jid, 3, $rewardAmount);
            }

            Donate::DonateLog([
                'method' => "Vote [{$config['name']}]",
                'value' => $rewardAmount,
                'jid' => $user->jid,
            ]);

            Vote::updateOrCreate(['jid' => $username, 'site' => $config['route']], ['ip' => $remoteIp, 'expire' => $now->addHours($timeout)]);

            return true;
        });

        $webhookSecret = $config['webhook_secret'];
        $signature = $request->header('X-Webhook-Signature');

        $result = $handler->handle(
            $request->all(),
            $request->ip(),
            $webhookSecret,
            $signature
        );
        return response()->json($result, $result['success'] ? 200 : 401);
    }
}
