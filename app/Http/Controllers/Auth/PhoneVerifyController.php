<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendVerifyCode;
use App\Services\WhatsAppService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PhoneVerifyController extends Controller
{
    /**
     * Display the phone verification view.
     */
    public function show(Request $request): View
    {
        $user = $request->user();

        if (! $user->phone) {
            return view('auth.verify-phone');
        }

        $this->issueCode($user);

        return view('auth.verify-phone');
    }

    /**
     * Generate and deliver a phone verification code (WhatsApp when available,
     * otherwise email).
     */
    public function issueCode(User $user): void
    {
        $code = random_int(100000, 999999);

        Cache::put('phone_verify_code_'.$user->id, $code, now()->addMinutes(30));

        $whatsapp = app(WhatsAppService::class);

        $sent = $user->phone
            && $whatsapp->sendText($user->phone, "Your phone verification code is: {$code}");

        if (! $sent) {
            $user->notify(new SendVerifyCode((string) $code));
        }
    }

    /**
     * Confirm the phone verification code.
     */
    public function confirm(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = $request->user();

        if (! $user->phone) {
            return redirect()->route('account.edit')->withErrors(['phone' => 'Set a phone number first.']);
        }

        if ($user->hasVerifiedPhone()) {
            return redirect()->route('account.edit');
        }

        $token = Cache::get('phone_verify_code_'.$user->id);

        if (! $token || (int) $request->code !== $token) {
            return back()->withErrors(['code' => 'The provided verification code is invalid or expired.']);
        }

        Cache::forget('phone_verify_code_'.$user->id);

        $user->update(['phone_verified_at' => now()]);

        return redirect()->route('account.edit')->with('status', 'phone-verified');
    }

    /**
     * Resend the phone verification code.
     */
    public function resend(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (! $user->phone) {
            return back()->withErrors(['phone' => 'Set a phone number first.']);
        }

        if (Cache::has('phone_verify_code_'.$user->id)) {
            return back()->withErrors(['code' => 'Please wait before requesting a new code.']);
        }

        $this->issueCode($user);

        return back()->with('status', 'verification-code-sent');
    }
}
