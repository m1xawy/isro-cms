<div class="card">
    <div class="card-header">{{ __('Profile Information') }}</div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24/build/css/intlTelInput.css">
        <style>
            #phone.iti__input,
            .iti {
                width: 100%;
            }
            .iti__country-list {
                z-index: 1100;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24/build/js/intlTelInput.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.querySelector('#phone');
                if (!input) {
                    return;
                }

                window.itiPhone = window.intlTelInput(input, {
                    initialCountry: 'auto',
                    geoIpLookup: (callback) => {
                        fetch('https://ipapi.co/json/')
                            .then((res) => res.json())
                            .then((data) => callback(data.country_code))
                            .catch(() => callback('us'));
                    },
                    utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@24/build/js/utils.js',
                });

                const normalize = () => {
                    if (window.itiPhone.isValidNumber()) {
                        input.value = window.itiPhone.getNumber();
                    }
                };

                input.addEventListener('blur', normalize);

                const form = input.closest('form');
                if (form) {
                    form.addEventListener('submit', normalize);
                }
            });
        </script>
    @endpush

    <div class="card-body">
        <form id="send-verification" class="d-none" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        @if(config('global.account_verify', 0))
            <form id="send-verify-code" method="POST" action="{{ route('account.resend.verify.code') }}">
                @csrf
                <input type="hidden" name="context" id="verify-context">
            </form>
        @endif

        <form method="POST" action="{{ route('account.update') }}">
            @csrf
            @method('patch')

            <div class="row mb-3">
                <label for="name" class="col-lg-4 col-form-label text-md-end">
                    {{ __('Username') }}
                </label>

                <div class="col-lg-6">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required disabled>

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-lg-4 col-form-label text-md-end">
                    {{ __('Email') }}
                </label>

                <div class="col-lg-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" @if(config('global.account_verify', 0)) disabled @endif required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="mb-0">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="btn btn-link p-0">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <div class="alert alert-success mt-3 mb-0" role="alert">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

<div class="row mb-3">
                <label for="phone" class="col-lg-4 col-form-label text-md-end">
                    {{ __('Phone') }}
                </label>

                <div class="col-lg-6">
                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="phone">

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    @if ($user->phone && ! $user->hasVerifiedPhone())
                        <div class="mt-2">
                            <p class="mb-0">
                                {{ __('Your phone number is unverified.') }}

                                <a href="{{ route('phone.verify') }}" class="btn btn-link p-0">
                                    {{ __('Click here to verify it.') }}
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            @if(config('global.account_verify', 0))
                @include('account.partials.input._verify_code', ['name' => 'verify_code_email'])
                @include('account.partials.input._new_email')
                @include('account.partials.input._verify_login')
            @endif

            <div class="row mb-0">
                <div class="col-lg-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
                    </button>
                    @if (session('status') === 'profile-updated')
                        <span class="m-1 fade-out">{{ __('Saved.') }}</span>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
