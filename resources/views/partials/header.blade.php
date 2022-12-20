<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ route('home') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <span class="fs-4">AUCTION</span>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <x-header-menu-item title="{{ __('pages/header.lots') }}" routeName="public.lots.all" />
                <x-header-menu-item title="{{ __('pages/header.actions') }}" routeName="public.actions" />

                <li><a href="#" class="nav-link px-2 link-dark">{{ __('pages/header.about') }}</a></li>

            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{route('public.lots.search')}}" method="GET">

                <input type="search" name="search" class="form-control" placeholder="{{ __('pages/header.search') }}..." aria-label="{{ __('pages/header.search') }}">
            </form>
            <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <a class="nav-link dropdown-toggle" id="navbarDropdownBlog" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ \App\Enums\LocalizationEnum::from(App::getLocale())->text() }}</a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
                    @foreach(\App\Enums\LocalizationEnum::cases() as $local)
                        <li><a class="dropdown-item" href="{{ Localization::localizedUrl($local->value) }}">
                               {{ $local->text() }}
                                @if(App::getLocale() === $local->value)
                                    &#10003;
                                @endif
                            </a>

                        </li>
                    @endforeach

                </ul>
            </div>
            @guest()
            <div class="text-end">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">{{ __('pages/header.login') }}</a>
                <a href="{{ route('register') }}" class="btn btn-primary">{{ __('pages/header.signup') }}</a>
            </div>
            @endguest
            @auth()
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('img/users/avatar.png')}}" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                    <li><a class="dropdown-item" href="{{ route('lots.index') }}">{{ __('My lots') }}</a></li>
                    <li><a class="dropdown-item" href="{{ route('lots.favorites') }}">{{ __('Favorites') }}</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Sign out</button>
                    </form>
                    </li>

                </ul>
            </div>
            @endauth
        </div>
    </div>
</header>
