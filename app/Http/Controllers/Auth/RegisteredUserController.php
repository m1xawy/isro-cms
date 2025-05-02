<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SRO\Account\SkSilk;
use App\Models\SRO\Account\TbUser;
use App\Models\SRO\Portal\AphChangedSilk;
use App\Models\SRO\Portal\AuhAgreedService;
use App\Models\SRO\Portal\MuEmail;
use App\Models\SRO\Portal\MuhAlteredInfo;
use App\Models\SRO\Portal\MuJoiningInfo;
use App\Models\SRO\Portal\MuUser;
use App\Models\SRO\Portal\MuVIPInfo;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'regex:/^[A-Za-z0-9]*$/', 'min:6', 'max:16', 'unique:'.User::class, 'unique:'.TbUser::class.',StrUserID'],
            'email' => ['required', 'string', 'email', 'max:70', 'unique:'.TbUser::class.',Email'],
            'password' => ['required', 'string', 'min:6', 'max:32', 'confirmed', Rules\Password::defaults()],
            'g-recaptcha-response' => [
                Rule::requiredIf(function () {
                    return env('NOCAPTCHA_ENABLE', false);
                }),
                'captcha'
            ],
        ]);

        DB::beginTransaction();
        try {
            $tbUser = TbUser::setGameAccount($request->username, $request->password, $request->email, $request->ip());
            SkSilk::setSkSilk($tbUser->JID, 0, 0);

            $user = User::create([
                'jid' => $tbUser->JID,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['username' => [$e->getMessage()]]);
        }
        DB::commit();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('profile', absolute: false));
    }
}
