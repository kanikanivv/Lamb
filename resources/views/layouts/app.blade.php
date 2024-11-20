<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Lamb">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- icon  -->
    <link rel="icon" href="images/favicon.png" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/user-style.css') }}">
</head>

<body>
    <div class="container-wrpper border-bottom">
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-4">
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="{{ route('items.index') }}" class="logo d-inline-flex link-body-emphasis text-decoration-none">
                        Lamb
                    </a>
                </div>
                <ul class="tools nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href=""><img src="{{ asset('images/AddShoppingCart.svg') }}" alt="カート"></a></li>
                    <li><a><img src="{{ asset('images/FavoriteBorder.svg') }}" alt="お気に入り"></a></li>
                    <li><a><img src="{{ asset('images/PersonOutline.svg') }}" alt="プロフィール"></a></li>
                </ul>
            </header>
        </div>
    </div>

        @yield('content')

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
