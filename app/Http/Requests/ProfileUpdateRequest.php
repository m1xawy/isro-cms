<?php

namespace App\Http\Requests;

use App\Models\SRO\Account\TbUser;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:32', 'regex:/^\+?[0-9]{7,15}$/'],
            'verify_code_email' => array_filter([
                config('global.account_verify') ? 'required' : null,
                'string',
            ]),
            'new_email' => array_filter([
                'nullable',
                'email',
                ! config('global.duplicate_email', 1) ? Rule::unique('users', 'email')->ignore($this->user()->id) : null,
            ]),

            'email' => array_filter([
                ! config('global.account_verify') ? 'required' : null,
                'string',
                'lowercase',
                'email',
                'max:255',
                ! config('global.duplicate_email', 1) ? Rule::unique(User::class)->ignore($this->user()->id) : null,

                function ($attribute, $value, $fail) {
                    if (config('global.server.version') === 'vSRO' && ! config('global.duplicate_email', 1)) {
                        $exists = TbUser::where('Email', $value)->where('JID', '!=', $this->user()->jid)->exists();
                        if ($exists) {
                            $fail('The email has already been taken in another account.');
                        }
                    }
                },
            ]),
        ];
    }
}
