<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        if (config('global.account_verify')) {
            return $this->updatePasswordByCode($request);
        }

        return $this->updatePasswordByCurrent($request);
    }

    protected function updatePasswordByCurrent(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:6', 'max:32', 'confirmed'],
        ]);

        $user = $request->user();

        $user->updateGamePassword($validated['password']);

        $user->update(['password' => $validated['password']]);

        return back()->with('status', 'password-updated');
    }

    protected function updatePasswordByCode(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'verify_code_password' => ['required', 'string'],
            'password' => ['required', 'min:6', 'max:32', 'confirmed'],
        ]);

        $user = $request->user();
        $token = Cache::get('verify_code_'.$user->email);

        if (!$token || (int) $request->verify_code_password !== $token) {
            return back()->withErrors([
                'verify_code_password' => 'The provided verification code is invalid or expired.',
            ]);
        }

        $user->updateGamePassword($validated['password']);

        $user->update(['password' => $validated['password']]);

        Cache::forget('verify_code_'.$user->email);

        return back()->with('status', 'password-updated');
    }
}
