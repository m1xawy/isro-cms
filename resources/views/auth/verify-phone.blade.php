@extends('layouts.guest')
@section('title', __('Phone Verification'))

@section('content')
    <section class="card">
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="mt-5">{{ __('Phone Verification') }}</h2>

                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(!auth()->user()->phone)
                            <div class="alert alert-warning mt-3" role="alert">
                                {{ __('You have not set a phone number yet. Add one from your account settings first.') }}
                            </div>

                            <a href="{{ route('account.edit') }}" class="btn btn-primary">
                                {{ __('Go to Account Settings') }}
                            </a>
                        @elseif(auth()->user()->hasVerifiedPhone())
                            <div class="alert alert-success mt-3" role="alert">
                                {{ __('Your phone number is verified.') }}
                            </div>

                            <a href="{{ route('account.edit') }}" class="btn btn-primary">
                                {{ __('Back to Account Settings') }}
                            </a>
                        @else
                            <p class="text-muted mb-4">
                                {{ __('We sent a 6-digit verification code to your phone number.') }}
                            </p>

                            <form method="POST" action="{{ route('phone.verify.confirm') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="code" class="form-label">{{ __('Verification Code') }}</label>
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autofocus placeholder="Enter 6-digit code">

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Verify') }}
                                    </button>

                                    <button type="submit" form="phone_verify_resend" class="btn btn-link">
                                        {{ __('Resend code') }}
                                    </button>
                                </div>
                            </form>
                            <form method="POST" id="phone_verify_resend" action="{{ route('phone.verify.resend') }}">
                                @csrf
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection