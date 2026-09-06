<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\WhatsAppService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('account', absolute: false));
        }

        if (! config('global.register_confirm')) {
            return redirect()->intended(route('account', absolute: false));
        }

        $user = $request->user();

        if (! empty($user->phone)
            && app(WhatsAppService::class)->enabled()
            && config('services.whatsapp.confirm_enabled', false)) {
            app(WhatsAppService::class)->sendVerificationLink($user);
        } else {
            $user->sendEmailVerificationNotification();
        }

        return back()->with('status', 'verification-link-sent');
    }
}
