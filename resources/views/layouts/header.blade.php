<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset(config('global.site_logo')) }}" alt="" width="" height="64">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">{{ __('News') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('download') ? 'active' : '' }}" href="{{ route('download') }}">{{ __('Download') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ranking') ? 'active' : '' }}" href="{{ route('ranking') }}">{{ __('Ranking') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('logs.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Server History') }}</a>
                        <ul class="dropdown-menu">
                            @if(config("global.logs.schedule"))
                                <li><a class="dropdown-item" href="{{ route('logs.schedule') }}">{{ __('Event Schedule') }}</a></li>
                            @endif
                            @if(config("global.logs.unique"))
                                <li><a class="dropdown-item" href="{{ route('logs.unique') }}">{{ __('Unique Tracker') }}</a></li>
                            @endif
                            @if(config("global.logs.unique_advanced"))
                                <li><a class="dropdown-item" href="{{ route('logs.unique-advanced') }}">{{ __('Advanced Unique Tracker') }}</a></li>
                            @endif
                            @if(config("global.logs.fortress"))
                                <li><a class="dropdown-item" href="{{ route('logs.fortress') }}">{{ __('Fortress History') }}</a></li>
                            @endif
                            @if(config("global.logs.global"))
                                <li><a class="dropdown-item" href="{{ route('logs.global') }}">{{ __('Global History') }}</a></li>
                            @endif
                            @if(config("global.logs.item_plus"))
                                <li><a class="dropdown-item" href="{{ route('logs.item-plus') }}">{{ __('Item Plus') }}</a></li>
                            @endif
                            @if(config("global.logs.item_drop"))
                                <li><a class="dropdown-item" href="{{ route('logs.item-drop') }}">{{ __('Item Drop') }}</a></li>
                            @endif
                            @if(config("global.logs.pvp_kill"))
                                <li><a class="dropdown-item" href="{{ route('logs.pvp-kill') }}">{{ __('Pvp Kills') }}</a></li>
                            @endif
                            @if(config("global.logs.job_kill"))
                                <li><a class="dropdown-item" href="{{ route('logs.job-kill') }}">{{ __('Job Kills') }}</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('pages.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Information') }}</a>
                        <ul class="dropdown-menu">
                            @forelse ($pages as $row)
                            <li><a class="dropdown-item" href="{{ route('pages.show', ['slug' => $row->slug]) }}">{{ $row->title }}</a></li>
                            @empty
                            <li><a class="dropdown-item" href="#">{{ __('No Pages') }}</a></li>
                            @endforelse
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @if(config('global.dark_mode') == 'switch')
                    @push('scripts')
                        <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
                    @endpush

                    <li class="nav-item dropdown bd-mode-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                            <symbol id="check2" viewBox="0 0 16 16">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
                            </symbol>
                            <symbol id="circle-half" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
                            </symbol>
                            <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                                <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
                                <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
                            </symbol>
                            <symbol id="sun-fill" viewBox="0 0 16 16">
                                <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
                            </symbol>
                        </svg>

                        <button class="nav-link dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                            <svg class="bi my-1 theme-icon-active" aria-hidden="true" style="width: 1em; height: 1em;fill: #fff; ">
                                <use href="#circle-half"></use>
                            </svg>
                            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="bd-theme-text">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                                    <svg class="bi me-2 opacity-50" aria-hidden="true" style="width: 1em; height: 1em;">
                                        <use href="#sun-fill"></use>
                                    </svg>
                                    Light
                                    <svg class="bi ms-auto d-none" aria-hidden="true">
                                        <use href="#check2"></use>
                                    </svg>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                    <svg class="bi me-2 opacity-50" aria-hidden="true" style="width: 1em; height: 1em;">
                                        <use href="#moon-stars-fill"></use>
                                    </svg>
                                    Dark
                                    <svg class="bi ms-auto d-none" aria-hidden="true">
                                        <use href="#check2"></use>
                                    </svg>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                                    <svg class="bi me-2 opacity-50" aria-hidden="true" style="width: 1em; height: 1em;">
                                        <use href="#circle-half"></use>
                                    </svg>
                                    Auto
                                    <svg class="bi ms-auto d-none" aria-hidden="true">
                                        <use href="#check2"></use>
                                    </svg>
                                </button>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(config('global.default_locale') == 'switch')
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset(config('global.languages')[App::getLocale()]['image']) }}" alt="" style="width: 1em; height: 1em;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @foreach(config('global.languages') as $key => $row)
                            <li>
                                <a class="dropdown-item" href="{{ route('locale', $key) }}">
                                    <img src="{{ asset($row['image']) }}" alt="" style="width: 1em; height: 1em;"> {{ $row['name'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @auth
                    <li class="nav-item dropdown">
                        <a href="{{ route('account') }}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(auth()->user()->email))) }}?s=60&d=identicon" alt="mdo" width="32" height="32" class="rounded-circle">
                            {{ auth()->user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('account') }}">{{ __('Account Info') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('account.edit') }}">{{ __('Settings') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('account.donate') }}">{{ __('Donate') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @if(auth()->user()->role?->is_admin)
                            <li><a class="dropdown-item" href="{{ route('admin') }}">{{ __('Admin Panel') }}</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); fetch('{{ route('logout') }}', {method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}}).then(() => window.location.href = '/')">{{ __('Logout') }}</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
