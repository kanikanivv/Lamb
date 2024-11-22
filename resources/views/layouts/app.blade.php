<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Lamb">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Styles --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/user-style.css') }}">


    {{-- Scripts --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container-wrpper border-bottom">
                <div class="container">
                    <header
                        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-4">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <a class="navbar-brand logo d-inline-flex link-body-emphasis text-decoration-none"
                                href="{{ route('items.index') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">
                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="tools nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                                <!-- Authentication Links -->
                                @guest

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}"><img src="{{ asset('images/AddShoppingCart.svg') }}" alt="カート"></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><img src="{{ asset('images/FavoriteBorder.svg') }}" alt="お気に入り"></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><img src="{{ asset('images/PersonOutline.svg') }}" alt="プロフィール"></a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('carts.index') }}"><img src="{{ asset('images/AddShoppingCart.svg') }}" alt="カート"></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><img src="{{ asset('images/FavoriteBorder.svg') }}" alt="お気に入り"></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><img src="{{ asset('images/PersonOutline.svg') }}" alt="プロフィール"></a>
                                    </li>
                                    <li class="nav-logout">
                                        <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('ログアウト') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf</form>
                                @endguest
                            </ul>
                        </div>
                        </head>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="gl-footer">
        <div class="container-wrap">
            <div class="container">
                <div class="logo">Lamb</div>
                <ul class="footer-nav">
                    <li><a>会社概要</a></li>
                    <li><a>個人情報保護方針</a></li>
                    <li><a>特定商取引法に基づく表示</a></li>
                    <li><a>商品一覧</a></li>
                </ul>
            </div>
        </div>
        <p class="copyright"><small>Copyright &copy; 2024 Lamb. All Rights Reserved.</small></p>
    </footer>
</body>

</html>
