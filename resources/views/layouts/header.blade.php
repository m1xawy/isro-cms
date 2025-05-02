<header class="p-3 text-bg-dark">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ url('/') }}" class="d-flex align-items-center me-3 mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="{{ asset(config('settings.site_logo', 'images/logo.png')) }}" alt="" width="" height="40" class="">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ url('/') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} px-2 text-white">{{ __('Home') }}</a></li>
                <li><a href="{{ route('pages.download') }}" class="nav-link {{ request()->routeIs('pages.download') ? 'active' : '' }} px-2 text-white">{{ __('Download') }}</a></li>
                <li><a href="{{ route('ranking') }}" class="nav-link {{ request()->routeIs('ranking') ? 'active' : '' }} px-2 text-white">{{ __('Ranking') }}</a></li>

                <li class="dropdown">
                    <a href="#" class="nav-link px-2 text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Search') }}</a>
                    <ul class="dropdown-menu" style="">
                        <li><a class="dropdown-item" href="{{ route('pages.timers') }}">{{ __('Event Times') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('pages.uniques') }}">{{ __('Unique Tracker') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('pages.uniques-advanced') }}">{{ __('Advanced Unique Tracker') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('pages.fortress') }}">{{ __('Fortress History') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('pages.globals') }}">{{ __('Global History') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link px-2 text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Pages') }}</a>
                    <ul class="dropdown-menu" style="">
                        @forelse ($pages as $page)
                            <li><a class="dropdown-item" href="{{ route('pages.page.show', ['slug' => $page->slug]) }}">{{ $page->title }}</a></li>
                        @empty
                            <li><a class="dropdown-item" href="#">{{ __('No Pages') }}</a></li>
                        @endforelse
                    </ul>
                </li>
            </ul>

            <div class="d-flex text-end">
                @if(config('settings.dark_mode') == 'switch')
                <div class="dropdown bd-mode-toggle">
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

                    <a class="nav-link px-3 py-1 text-white dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (light)">
                        <svg class="bi my-1 theme-icon-active" aria-hidden="true"><use href="#sun-fill"></use></svg>
                        <span class="visually-hidden" id="bd-theme-text">{{ __('Toggle theme') }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text" style="">
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                                <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#sun-fill"></use></svg>
                                {{ __('Light') }}
                                <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#moon-stars-fill"></use></svg>
                                {{ __('Dark') }}
                                <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                                <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#circle-half"></use></svg>
                                {{ __('Auto') }}
                                <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>
                            </button>
                        </li>
                    </ul>
                </div>
                @endif

                @if(config('settings.default_locale') == 'switch')
                <div class="dropdown">
                    <a href="#" class="nav-link px-3 py-2 text-white dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fi fi-{{ config('global.general.languages')[App::getLocale()]['fi'] }}"></span>
                    </a>
                    <ul class="dropdown-menu" style="">
                        @foreach(config('global.general.languages') as $key => $value)
                            <li>
                                <a class="dropdown-item" href="{{ route('lang.switch', $key) }}">
                                    <span class="fi fi-{{ $value['fi'] }}"></span>
                                    {{ $value['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (Route::has('login'))
                    @auth
                        <div class="dropdown">
                            <a href="{{ route('profile') }}" class="d-block text-decoration-none dropdown-toggle px-3 py-1 text-white" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('Account') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Settings') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.donate') }}">{{ __('Donate') }}</a></li>
                                @admin
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.home') }}">{{ __('Admin panel') }}</a></li>
                                @endadmin
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Log Out') }}</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">{{ __('Log in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-warning">{{ __('Register') }}</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</header>
