@extends('admin.layouts.app')
@section('title', __('Settings'))

@section('content')
    <div>

        {{-- Page Header --}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ __('Settings') }}</h1>
            <form action="{{ route('admin.settings.clear-cache') }}" method="POST"
                  onsubmit="return confirm('{{ __('Are you sure you want to clear all caches?') }}')">
                @csrf
                <button type="submit" class="btn btn-danger">{{ __('Clear All Cache') }}</button>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-general" type="button" role="tab">{{ __('General') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-mail" type="button" role="tab">{{ __('Mail') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-captcha" type="button" role="tab">{{ __('Captcha') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-cache" type="button" role="tab">{{ __('Cache') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-sliders" type="button" role="tab">{{ __('Sliders') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-footer" type="button" role="tab">{{ __('Footer') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-history" type="button" role="tab">{{ __('History') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-referral" type="button" role="tab">{{ __('Referral') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-tickets" type="button" role="tab">{{ __('Tickets') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-vote" type="button" role="tab">{{ __('Vote') }}</button>
            </li>
        </ul>

        <form method="POST" action="{{ route('admin.settings.update') }}" onsubmit="serializeGeneral()">
            @csrf

            <div class="tab-content">

                {{-- ===================== GENERAL ===================== --}}
                <div class="tab-pane fade show active" id="tab-general" role="tabpanel">

                    <h5 class="fw-semibold mb-3">{{ __('Site Settings') }}</h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Site Title') }}</label>
                        <input type="text" class="form-control" name="site_name" value="{{ $settings['site_name'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Site Description') }}</label>
                        <input type="text" class="form-control" name="site_desc" value="{{ $settings['site_desc'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Site URL') }}</label>
                        <input type="text" class="form-control" name="site_url" value="{{ $settings['site_url'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Site Favicon') }}</label>
                        <input type="text" class="form-control" name="site_favicon" value="{{ $settings['site_favicon'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Site Logo') }}</label>
                        <input type="text" class="form-control" name="site_logo" value="{{ $settings['site_logo'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Background') }}</label>
                        <input type="text" class="form-control" name="site_background" value="{{ $settings['site_background'] ?? '' }}">
                    </div>

                    <h5 class="fw-semibold mb-3 mt-4">{{ __('Server Settings') }}</h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Max Online Players') }}</label>
                        <input type="number" class="form-control" name="max_player" value="{{ $settings['max_player'] ?? '' }}" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Fake Player Count') }}</label>
                        <input type="number" class="form-control" name="fake_player" value="{{ $settings['fake_player'] ?? '' }}" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Max Character Level') }}</label>
                        <input type="number" class="form-control" name="max_level" value="{{ $settings['max_level'] ?? '' }}" min="1">
                    </div>

                    <h5 class="fw-semibold mb-3 mt-4">{{ __('Appearance') }}</h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Dark Mode') }}</label>
                        <select class="form-select" name="dark_mode">
                            <option value="switch" {{ ($settings['dark_mode'] ?? '') === 'switch' ? 'selected' : '' }}>Switch</option>
                            <option value="light"  {{ ($settings['dark_mode'] ?? '') === 'light'  ? 'selected' : '' }}>Light</option>
                            <option value="dark"   {{ ($settings['dark_mode'] ?? '') === 'dark'   ? 'selected' : '' }}>Dark</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Default Language') }}</label>
                        <select class="form-select" name="default_locale">
                            <option value="switch" {{ ($settings['default_locale'] ?? '') === 'switch' ? 'selected' : '' }}>Switch</option>
                            @foreach($languages as $code => $item)
                                <option value="{{ $code }}" {{ ($settings['default_locale'] ?? '') === $code ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Theme') }}</label>
                        <select class="form-select" name="theme">
                            <option value="default" {{ ($settings['theme'] ?? '') === 'default' ? 'selected' : '' }}>Default</option>
                            @foreach($themes as $theme)
                                <option value="{{ $theme }}" {{ ($settings['theme'] ?? '') === $theme ? 'selected' : '' }}>
                                    {{ ucfirst($theme) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Timezone') }}</label>
                        <select class="form-select" name="timezone">
                            @foreach($timezones as $tz)
                                <option value="{{ $tz }}" {{ ($settings['timezone'] ?? '') === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h5 class="fw-semibold mb-3 mt-4">{{ __('User Settings') }}</h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Account Verification') }}</label>
                        <select class="form-select" name="account_verify">
                            <option value="0" {{ ($settings['account_verify'] ?? '') === '0' ? 'selected' : '' }}>Disabled</option>
                            <option value="1" {{ ($settings['account_verify'] ?? '') === '1' ? 'selected' : '' }}>Enabled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">{{ __('Disable Register') }}</label>
                        <div class="form-check">
                            <input type="hidden" name="disable_register" value="0">
                            <input class="form-check-input" type="checkbox" name="disable_register" value="1"
                                   id="disable_register" {{ !empty($settings['disable_register']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="disable_register">{{ __('Enabled') }}</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">{{ __('Register Confirmation') }}</label>
                        <div class="form-check">
                            <input type="hidden" name="register_confirm" value="0">
                            <input class="form-check-input" type="checkbox" name="register_confirm" value="1"
                                   id="register_confirm" {{ !empty($settings['register_confirm']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="register_confirm">{{ __('Enabled') }}</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">{{ __('Duplicate Email (vSRO)') }}</label>
                        <div class="form-check">
                            <input type="hidden" name="duplicate_email" value="0">
                            <input class="form-check-input" type="checkbox" name="duplicate_email" value="1"
                                   id="duplicate_email" {{ !empty($settings['duplicate_email']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="duplicate_email">{{ __('Enabled') }}</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">{{ __('Agree Terms') }}</label>
                        <div class="form-check">
                            <input type="hidden" name="agree_terms" value="0">
                            <input class="form-check-input" type="checkbox" name="agree_terms" value="1"
                                   id="agree_terms" {{ !empty($settings['agree_terms']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="agree_terms">{{ __('Enabled') }}</label>
                        </div>
                    </div>
                </div>

                {{-- ===================== MAIL ===================== --}}
                <div class="tab-pane fade" id="tab-mail" role="tabpanel">

                    <h5 class="fw-semibold mb-3">{{ __('Mail Configuration') }}</h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Mailer') }}</label>
                        <select class="form-select" id="mail_mailer">
                            @foreach(['log' => 'Log (debug)', 'smtp' => 'SMTP', 'sendmail' => 'Sendmail', 'mailgun' => 'Mailgun', 'ses' => 'Amazon SES', 'postmark' => 'Postmark'] as $val => $label)
                                <option value="{{ $val }}" {{ ($mail['MAIL_MAILER'] ?? 'log') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">{{ __('Use "Log" for local testing — emails are written to storage/logs instead of being sent.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Host') }}</label>
                        <input type="text" class="form-control" id="mail_host"
                               value="{{ $mail['MAIL_HOST'] ?? '127.0.0.1' }}" placeholder="smtp.mailtrap.io">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Port') }}</label>
                        <input type="number" class="form-control" id="mail_port"
                               value="{{ $mail['MAIL_PORT'] ?? 2525 }}" placeholder="2525">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Scheme') }}</label>
                        <select class="form-select" id="mail_scheme">
                            @foreach(['null' => 'None', 'tls' => 'TLS', 'ssl' => 'SSL'] as $val => $label)
                                <option value="{{ $val }}" {{ ($mail['MAIL_SCHEME'] ?? 'null') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Username') }}</label>
                        <input type="text" class="form-control" id="mail_username"
                               value="{{ ($mail['MAIL_USERNAME'] ?? 'null') !== 'null' ? ($mail['MAIL_USERNAME'] ?? '') : '' }}"
                               placeholder="null">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Password') }}</label>
                        <input type="text" class="form-control" id="mail_password"
                               value="{{ ($mail['MAIL_PASSWORD'] ?? 'null') !== 'null' ? ($mail['MAIL_PASSWORD'] ?? '') : '' }}"
                               placeholder="null">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('From Address') }}</label>
                        <input type="email" class="form-control" id="mail_from_address"
                               value="{{ $mail['MAIL_FROM_ADDRESS'] ?? 'hello@example.com' }}" placeholder="hello@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('From Name') }}</label>
                        <input type="text" class="form-control" id="mail_from_name"
                               value="{{ $mail['MAIL_FROM_NAME'] ?? $appName }}" placeholder="{{ $appName }}">
                    </div>

                    <input type="hidden" id="mail" name="mail">
                </div>

                {{-- ===================== CAPTCHA ===================== --}}
                <div class="tab-pane fade" id="tab-captcha" role="tabpanel">

                    <h5 class="fw-semibold mb-3">{{ __('reCAPTCHA Configuration') }}</h5>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="captcha_enabled"
                                {{ !empty($captcha['enabled']) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="captcha_enabled">{{ __('Enable Captcha') }}</label>
                        </div>
                        <div class="form-text">{{ __('Protects login, register, and contact forms from bots.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Site Key') }}</label>
                        <input type="text" class="form-control" id="captcha_sitekey"
                               value="{{ $captcha['sitekey'] ?? '' }}" placeholder="NOCAPTCHA_SITEKEY">
                        <div class="form-text">
                            {{ __('The public key used in the frontend widget.') }}
                            <a href="https://www.google.com/recaptcha/admin" target="_blank">{{ __('Get keys from Google') }} &nearr;</a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Secret Key') }}</label>
                        <input type="text" class="form-control" id="captcha_secret"
                               value="{{ $captcha['secret'] ?? '' }}" placeholder="NOCAPTCHA_SECRET">
                        <div class="form-text">{{ __('The private key used for server-side verification. Keep this secret.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Timeout (seconds)') }}</label>
                        <input type="number" class="form-control" id="captcha_timeout"
                               min="1" max="120" value="{{ $captcha['options']['timeout'] ?? 30 }}">
                    </div>

                    <input type="hidden" id="captcha" name="captcha">
                </div>

                {{-- ===================== CACHE ===================== --}}
                <div class="tab-pane fade" id="tab-cache" role="tabpanel">

                    <h5 class="fw-semibold mb-3">{{ __('Cache Settings') }}</h5>
                    <p class="text-muted small mb-3">{{ __('All values are in seconds.') }}</p>

                    @foreach($cache as $cacheKey => $cacheValue)
                        <div class="mb-3">
                            <label class="form-label">{{ ucwords(str_replace('_', ' ', $cacheKey)) }}</label>
                            <input type="number" class="form-control" name="cache[{{ $cacheKey }}]"
                                   value="{{ $cacheValue }}" min="0">
                        </div>
                    @endforeach
                </div>

                {{-- ===================== SLIDERS ===================== --}}
                <div class="tab-pane fade" id="tab-sliders" role="tabpanel">

                    <p class="text-muted small mb-3">{{ __('Manage homepage carousel slides.') }}</p>

                    <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addSlide()">{{ __('+ Add Slide') }}</button>

                    <div id="slidersContainer">
                        @foreach($sliders as $index => $slide)
                            <div class="card mb-3 slider-item">
                                <div class="card-header slider-title">
                                    <span class="fw-semibold">{{ __('Slide') }} #{{ $index + 1 }}</span>
                                </div>
                                <div class="card-body slider-body">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Title') }}</label>
                                        <input type="text" class="form-control" data-sl="title" value="{{ $slide['title'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Description') }}</label>
                                        <textarea class="form-control" data-sl="desc" rows="2">{{ $slide['desc'] ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Image URL') }}</label>
                                        <input type="text" class="form-control" data-sl="image" value="{{ $slide['image'] ?? '' }}" placeholder="https://...">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Button Label') }}</label>
                                        <input type="text" class="form-control" data-sl="btn_label" value="{{ $slide['btn_label'] ?? '' }}" placeholder="Sign Up">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Button URL') }}</label>
                                        <input type="text" class="form-control" data-sl="btn_url" value="{{ $slide['btn_url'] ?? '#' }}" placeholder="#">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger"
                                            onclick="this.closest('.slider-item').remove(); reindexSliders()">
                                        {{ __('Remove') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <input type="hidden" id="sliders" name="sliders">
                </div>

                {{-- ===================== FOOTER ===================== --}}
                <div class="tab-pane fade" id="tab-footer" role="tabpanel">

                    <h5 class="fw-semibold mb-3">{{ __('General Links') }}</h5>
                    <p class="text-muted small mb-3">{{ __('Navigation links shown in the footer.') }}</p>

                    <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addFooterGeneralRow()">{{ __('+ Add Row') }}</button>

                    <table class="table table-bordered align-middle mb-4" id="footer-general">
                        <thead >
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('URL') }}</th>
                            <th style="width: 80px;">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($footer['general'] ?? [] as $item)
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" data-fi="name" value="{{ $item['name'] ?? '' }}"></td>
                                <td><input type="text" class="form-control form-control-sm" data-fi="url"  value="{{ $item['url']  ?? '' }}"></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" data-fi="name" placeholder="{{ __('Home') }}"></td>
                                <td><input type="text" class="form-control form-control-sm" data-fi="url"  placeholder="#"></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <h5 class="fw-semibold mb-3">{{ __('Social Links') }}</h5>
                    <p class="text-muted small mb-3">{{ __('Social media links. Use Font Awesome icon HTML in the Icon column.') }}</p>

                    <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addFooterSocialRow()">{{ __('+ Add Row') }}</button>

                    <table class="table table-bordered align-middle mb-4" id="footer-social">
                        <thead >
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('URL') }}</th>
                            <th>{{ __('Icon (FA HTML)') }}</th>
                            <th style="width: 80px;">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($footer['social'] ?? [] as $item)
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" data-fi="name"  value="{{ $item['name']  ?? '' }}"></td>
                                <td><input type="text" class="form-control form-control-sm" data-fi="url"   value="{{ $item['url']   ?? '' }}"></td>
                                <td><input type="text" class="form-control form-control-sm font-monospace"  data-fi="image" value="{{ $item['image'] ?? '' }}" placeholder='<i class="fab fa-facebook-f"></i>'></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" data-fi="name"  placeholder="Facebook"></td>
                                <td><input type="text" class="form-control form-control-sm" data-fi="url"   placeholder="https://facebook.com/..."></td>
                                <td><input type="text" class="form-control form-control-sm font-monospace"  data-fi="image" placeholder='<i class="fab fa-facebook-f"></i>'></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <h5 class="fw-semibold mb-3">{{ __('Backlinks') }}</h5>
                    <p class="text-muted small mb-3">{{ __('External sites that link back to your server.') }}</p>

                    <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addFooterBacklinkRow()">{{ __('+ Add Row') }}</button>

                    <table class="table table-bordered align-middle" id="footer-backlink">
                        <thead >
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('URL') }}</th>
                            <th>{{ __('Image URL') }}</th>
                            <th style="width: 80px;">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($footer['backlink'] ?? [] as $item)
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" data-fi="name"  value="{{ $item['name']  ?? '' }}"></td>
                                <td><input type="text" class="form-control form-control-sm" data-fi="url"   value="{{ $item['url']   ?? '' }}"></td>
                                <td><input type="text" class="form-control form-control-sm" data-fi="image" value="{{ $item['image'] ?? '' }}" placeholder="https://example.com/logo.png"></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" data-fi="name"  placeholder="Elitepvpers"></td>
                                <td><input type="text" class="form-control form-control-sm" data-fi="url"   placeholder="https://..."></td>
                                <td><input type="text" class="form-control form-control-sm" data-fi="image" placeholder="https://example.com/logo.png"></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <input type="hidden" id="footer" name="footer">
                </div>

                {{-- ===================== HISTORY ===================== --}}
                <div class="tab-pane fade" id="tab-history" role="tabpanel">

                    <h5 class="fw-semibold mb-3">{{ __('History Features') }}</h5>
                    <p class="text-muted small mb-3">{{ __('Enable or disable history tracking features.') }}</p>

                    <div class="d-flex flex-column gap-2">
                        @foreach([
                            'schedule'        => __('Event Schedule'),
                            'unique'          => __('Unique Tracker'),
                            'unique_advanced' => __('Advanced Unique Tracker'),
                            'fortress'        => __('Fortress History'),
                            'global'          => __('Global History'),
                            'pvp_kill'        => __('PvP Kill Logs'),
                            'job_kill'        => __('Job Kill Logs'),
                            'item_plus'       => __('Item Plus Logs'),
                            'item_drop'       => __('Item Drop Logs'),
                        ] as $key => $label)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                       id="history_{{ $key }}" data-hist="{{ $key }}"
                                    {{ !empty($history[$key]) ? 'checked' : '' }}>
                                <label class="form-check-label" for="history_{{ $key }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>

                    <input type="hidden" id="history" name="history">
                </div>

                {{-- ===================== REFERRAL ===================== --}}
                <div class="tab-pane fade" id="tab-referral" role="tabpanel">

                    <h5 class="fw-semibold mb-3">{{ __('Referral System') }}</h5>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="referral_enabled"
                                {{ !empty($referral['enabled']) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="referral_enabled">{{ __('Enable Referral System') }}</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Reward Points') }}</label>
                        <input type="number" class="form-control" id="referral_reward_points"
                               min="0" value="{{ $referral['reward_points'] ?? 5 }}">
                        <div class="form-text">{{ __('Points awarded per referral. Set to 0 to disable rewards.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Minimum Redeem') }}</label>
                        <input type="number" class="form-control" id="referral_minimum_redeem"
                               min="0" value="{{ $referral['minimum_redeem'] ?? 25 }}">
                        <div class="form-text">{{ __('Minimum points required before a user can redeem.') }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Reward Silk Type') }}</label>
                        <select class="form-select" id="referral_reward_type">
                            @if(config('global.server.version') === 'vSRO')
                                <option value="0" {{ ($referral['reward_type'] ?? 0) == 0 ? 'selected' : '' }}>{{ __('Normal') }}</option>
                                <option value="1" {{ ($referral['reward_type'] ?? 0) == 1 ? 'selected' : '' }}>{{ __('Gift') }}</option>
                                <option value="2" {{ ($referral['reward_type'] ?? 0) == 2 ? 'selected' : '' }}>{{ __('Point') }}</option>
                            @else
                                <option value="3" {{ ($referral['reward_type'] ?? 3) == 3 ? 'selected' : '' }}>{{ __('Premium') }}</option>
                                <option value="1" {{ ($referral['reward_type'] ?? 3) == 1 ? 'selected' : '' }}>{{ __('Normal') }}</option>
                            @endif
                        </select>
                        <div class="form-text">{{ __('Silk type awarded when a user redeems their referral points.') }}</div>
                    </div>

                    <input type="hidden" id="referral" name="referral">
                </div>

                {{-- ===================== TICKETS ===================== --}}
                <div class="tab-pane fade" id="tab-tickets" role="tabpanel">

                    <h5 class="fw-semibold mb-3">{{ __('Ticket System') }}</h5>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tickets_enabled"
                                {{ !empty($tickets['enabled']) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="tickets_enabled">{{ __('Enable Ticket System') }}</label>
                        </div>
                    </div>

                    <h6 class="mb-1">{{ __('Categories') }}</h6>
                    <p class="text-muted small mb-3">{{ __('Define the ticket categories users can choose from.') }}</p>

                    <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addTicketCategory()">{{ __('+ Add Category') }}</button>

                    <table class="table table-bordered align-middle" id="ticketCategoriesTable">
                        <thead >
                        <tr>
                            <th>{{ __('Label') }}</th>
                            <th style="width: 80px;">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tickets['categories'] ?? [] as $catKey => $catLabel)
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" data-tc="label" value="{{ $catLabel }}"></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" data-tc="label" placeholder="Sales"></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <input type="hidden" id="tickets" name="tickets">
                </div>

                {{-- ===================== VOTE ===================== --}}
                <div class="tab-pane fade" id="tab-vote" role="tabpanel">

                    @foreach($vote as $voteKey => $voteItem)
                        <div class="card mb-3">
                            <div class="card-header fw-semibold">{{ $voteItem['name'] ?? ucfirst($voteKey) }}</div>
                            <div class="card-body">

                                <div class="alert alert-info py-2 mb-3">
                                    {{ __('Postback URL:') }} <code>{{ $appUrl }}/postback/{{ $voteKey }}</code>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               id="vote_{{ $voteKey }}_enabled"
                                            {{ !empty($voteItem['enabled']) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vote_{{ $voteKey }}_enabled">{{ __('Enabled') }}</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Vote Name') }}</label>
                                    <input type="text" class="form-control" id="vote_{{ $voteKey }}_name" value="{{ $voteItem['name'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Vote URL') }}</label>
                                    <input type="text" class="form-control font-monospace" id="vote_{{ $voteKey }}_url"
                                           value="{{ $voteItem['url'] ?? '' }}" placeholder="https://...{JID}">
                                    <div class="form-text">{{ __("Use {JID} as placeholder for the player's username.") }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Vote Image') }}</label>
                                    <input type="text" class="form-control font-monospace" id="vote_{{ $voteKey }}_image" value="{{ $voteItem['image'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Reward Points') }}</label>
                                    <input type="number" class="form-control" id="vote_{{ $voteKey }}_reward"
                                           min="0" value="{{ $voteItem['reward'] ?? 5 }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Reward Silk Type') }}</label>
                                    <select class="form-select" id="vote_{{ $voteKey }}_type">
                                        @if(config('global.server.version') === 'vSRO')
                                            <option value="0" {{ ($voteItem['type'] ?? 0) == 0 ? 'selected' : '' }}>{{ __('Normal') }}</option>
                                            <option value="1" {{ ($voteItem['type'] ?? 0) == 1 ? 'selected' : '' }}>{{ __('Gift') }}</option>
                                            <option value="2" {{ ($voteItem['type'] ?? 0) == 2 ? 'selected' : '' }}>{{ __('Point') }}</option>
                                        @else
                                            <option value="3" {{ ($voteItem['type'] ?? 3) == 3 ? 'selected' : '' }}>{{ __('Premium') }}</option>
                                            <option value="1" {{ ($voteItem['type'] ?? 3) == 1 ? 'selected' : '' }}>{{ __('Normal') }}</option>
                                        @endif
                                    </select>
                                    <div class="form-text">{{ __('Silk type awarded when a player votes on this site.') }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Timeout (hours)') }}</label>
                                    <input type="number" class="form-control" id="vote_{{ $voteKey }}_timeout"
                                           min="1" value="{{ $voteItem['timeout'] ?? 12 }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Allowed IP(s)') }}</label>
                                    <input type="text" class="form-control font-monospace" id="vote_{{ $voteKey }}_ip" value="{{ $voteItem['ip'] ?? '' }}">
                                </div>
                                @if($voteKey === 'vote4rewards')
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Webhook Secret') }}</label>
                                        <input type="text" class="form-control" id="vote_{{ $voteKey }}_webhook_secret"
                                               value="{{ $voteItem['webhook_secret'] ?? '' }}" placeholder="Q7A9DA2xVdkL3rP0B8mNfH5S3LJcWgUy">
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach

                    <input type="hidden" id="vote" name="vote">
                </div>

            </div>{{-- .tab-content --}}

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </form>
    </div>

    <script>
        // ─── Referral ─────────────────────────────────────────────────────────────────
        function serializeReferral() {
            document.getElementById('referral').value = JSON.stringify({
                enabled:        document.getElementById('referral_enabled').checked,
                reward_points:  parseInt(document.getElementById('referral_reward_points').value)  || 0,
                reward_type:    parseInt(document.getElementById('referral_reward_type').value)    || 0,
                minimum_redeem: parseInt(document.getElementById('referral_minimum_redeem').value) || 0,
            });
        }

        // ─── Ranking (History extra toggles) ─────────────────────────────────────────
        // ─── Tickets ──────────────────────────────────────────────────────────────────
        function addTicketCategory() {
            const tbody = document.querySelector('#ticketCategoriesTable tbody');
            const row   = tbody.insertRow();
            row.innerHTML = `
            <td><input type="text" class="form-control form-control-sm" data-tc="label" placeholder="Category Label"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>`;
        }

        function serializeTickets() {
            const categories = {};
            document.querySelectorAll('#ticketCategoriesTable tbody tr').forEach(tr => {
                const label = tr.querySelector('[data-tc="label"]').value.trim();
                if (label) {
                    const key = label.toLowerCase().replace(/[^a-z0-9]+/g, '_');
                    categories[key] = label;
                }
            });
            document.getElementById('tickets').value = JSON.stringify({
                enabled:    document.getElementById('tickets_enabled').checked,
                categories: categories,
            });
        }

        // ─── Sliders ──────────────────────────────────────────────────────────────────
        function reindexSliders() {
            document.querySelectorAll('#slidersContainer .slider-item').forEach((card, i) => {
                card.querySelector('.slider-title span').textContent = `{{ __('Slide') }} #${i + 1}`;
            });
        }

        function addSlide() {
            const container = document.getElementById('slidersContainer');
            const index     = container.querySelectorAll('.slider-item').length + 1;
            const card      = document.createElement('div');
            card.className  = 'card mb-3 slider-item';
            card.innerHTML  = `
            <div class="card-header slider-title">
                <span class="fw-semibold">{{ __('Slide') }} #${index}</span>
            </div>
            <div class="card-body slider-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('Title') }}</label>
                    <input type="text" class="form-control" data-sl="title">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control" data-sl="desc" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Image URL') }}</label>
                    <input type="text" class="form-control" data-sl="image" placeholder="https://...">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Button Label') }}</label>
                    <input type="text" class="form-control" data-sl="btn_label" placeholder="Sign Up">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Button URL') }}</label>
                    <input type="text" class="form-control" data-sl="btn_url" placeholder="#">
                </div>
                <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.slider-item').remove(); reindexSliders()">
                    {{ __('Remove') }}
            </button>
        </div>`;
            container.appendChild(card);
        }

        function serializeSliders() {
            const slides = Array.from(document.querySelectorAll('#slidersContainer .slider-item')).map(card => ({
                title: card.querySelector('[data-sl="title"]').value,
                desc:  card.querySelector('[data-sl="desc"]').value,
                image:       card.querySelector('[data-sl="image"]').value,
                btn_label:   card.querySelector('[data-sl="btn_label"]').value,
                btn_url:     card.querySelector('[data-sl="btn_url"]').value,
            }));
            document.getElementById('sliders').value = JSON.stringify(slides);
        }

        // ─── Footer ───────────────────────────────────────────────────────────────────
        function addFooterGeneralRow() {
            const tbody = document.querySelector('#footer-general tbody');
            const row   = tbody.insertRow();
            row.innerHTML = `
            <td><input type="text" class="form-control form-control-sm" data-fi="name" placeholder="{{ __('Home') }}"></td>
            <td><input type="text" class="form-control form-control-sm" data-fi="url"  placeholder="#"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>`;
        }

        function addFooterSocialRow() {
            const tbody = document.querySelector('#footer-social tbody');
            const row   = tbody.insertRow();
            row.innerHTML = `
            <td><input type="text" class="form-control form-control-sm" data-fi="name"  placeholder="Facebook"></td>
            <td><input type="text" class="form-control form-control-sm" data-fi="url"   placeholder="https://facebook.com/..."></td>
            <td><input type="text" class="form-control form-control-sm font-monospace"  data-fi="image" placeholder='&lt;i class="fab fa-facebook-f"&gt;&lt;/i&gt;'></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>`;
        }

        function addFooterBacklinkRow() {
            const tbody = document.querySelector('#footer-backlink tbody');
            const row   = tbody.insertRow();
            row.innerHTML = `
            <td><input type="text" class="form-control form-control-sm" data-fi="name"  placeholder="Elitepvpers"></td>
            <td><input type="text" class="form-control form-control-sm" data-fi="url"   placeholder="https://..."></td>
            <td><input type="text" class="form-control form-control-sm" data-fi="image" placeholder="https://example.com/logo.png"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">{{ __('Remove') }}</button></td>`;
        }

        function serializeFooter() {
            let existing = {};
            const existingInput = document.getElementById('footer');
            if (existingInput && existingInput.value) {
                try { existing = JSON.parse(existingInput.value); } catch {}
            }

            ['general', 'social', 'backlink'].forEach(section => {
                const table = document.getElementById('footer-' + section);
                if (! table) return;
                existing[section] = Array.from(table.querySelectorAll('tbody tr')).map(tr => ({
                    name:  tr.querySelector('[data-fi="name"]').value,
                    url:   tr.querySelector('[data-fi="url"]').value,
                    image: tr.querySelector('[data-fi="image"]')?.value ?? '',
                })).filter(r => r.name || r.url);
            });

            document.getElementById('footer').value = JSON.stringify(existing);
        }

        // ─── Vote ─────────────────────────────────────────────────────────────────────
        const voteKeys = @json(array_keys($vote));

        function serializeVote() {
            const result = {};
            voteKeys.forEach(key => {
                const enabled = document.getElementById('vote_' + key + '_enabled');
                if (! enabled) return;
                result[key] = {
                    enabled: enabled.checked,
                    route:   key,
                    name:    document.getElementById('vote_' + key + '_name')?.value    ?? '',
                    url:     document.getElementById('vote_' + key + '_url')?.value     ?? '',
                    image:   document.getElementById('vote_' + key + '_image')?.value   ?? '',
                    reward:  parseInt(document.getElementById('vote_' + key + '_reward')?.value)  || 5,
                    type:    parseInt(document.getElementById('vote_' + key + '_type')?.value)    || 0,
                    timeout: parseInt(document.getElementById('vote_' + key + '_timeout')?.value) || 12,
                    ip:      document.getElementById('vote_' + key + '_ip')?.value      ?? '',
                };
                const ws = document.getElementById('vote_' + key + '_webhook_secret');
                if (ws) result[key].webhook_secret = ws.value;
            });
            document.getElementById('vote').value = JSON.stringify(result);
        }

        // ─── Mail ─────────────────────────────────────────────────────────────────────
        function serializeMail() {
            document.getElementById('mail').value = JSON.stringify({
                MAIL_MAILER:       document.getElementById('mail_mailer').value,
                MAIL_HOST:         document.getElementById('mail_host').value,
                MAIL_PORT:         document.getElementById('mail_port').value,
                MAIL_SCHEME:       document.getElementById('mail_scheme').value,
                MAIL_USERNAME:     document.getElementById('mail_username').value || 'null',
                MAIL_PASSWORD:     document.getElementById('mail_password').value || 'null',
                MAIL_FROM_ADDRESS: document.getElementById('mail_from_address').value,
                MAIL_FROM_NAME:    document.getElementById('mail_from_name').value,
            });
        }

        // ─── Captcha ──────────────────────────────────────────────────────────────────
        function serializeCaptcha() {
            document.getElementById('captcha').value = JSON.stringify({
                enabled: document.getElementById('captcha_enabled').checked,
                sitekey: document.getElementById('captcha_sitekey').value,
                secret:  document.getElementById('captcha_secret').value,
                options: {
                    timeout: parseInt(document.getElementById('captcha_timeout').value) || 30,
                },
            });
        }

        // ─── History ──────────────────────────────────────────────────────────────────
        function serializeHistory() {
            const history = {};
            document.querySelectorAll('[data-hist]').forEach(input => {
                history[input.dataset.hist] = input.checked;
            });
            document.getElementById('history').value = JSON.stringify(history);
        }

        // ─── Main ─────────────────────────────────────────────────────────────────────
        function serializeGeneral() {
            serializeReferral();
            serializeTickets();
            serializeSliders();
            serializeFooter();
            serializeVote();
            serializeMail();
            serializeCaptcha();
            serializeHistory();
        }
    </script>
@endsection
