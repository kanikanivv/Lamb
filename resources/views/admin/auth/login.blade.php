<!DOCTYPE html>
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
    <link rel="stylesheet" href="{{ asset('/css/admin-style.css') }}">
</head>

<body class="admin-login">
    <div class="container page-parent container-admin-login">
        <main class="page-main">
            <div class="admin-login-block">
                <section class="login-form-sec">
                    <div class="admin-title">{{ __('admin-title') }}</div>
                    <form class="admin-form-login" action="{{ route('admin.login') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3 admin-form">
                            <label for="exampleInputEmail1" class="admin-form-label">{{ __('email') }}</label>
                            <input type="email" class="form-control admin-form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="メールアドレスを入力してください">
                        </div>
                        <div class="mb-3 admin-form">
                            <label for="exampleInputPassword1" class="admin-form-label">{{ __('password') }}</label>
                            <input type="password" class="form-control admin-form-control" id="exampleInputPassword1"
                                placeholder="パスワードを入力してください">
                        </div>
                        <div class="admin-btn"><button type="submit"
                                class="login-btn btn">{{ __('login') }}</button></div>
                    </form>
                </section>
            </div>
        </main>
        <aside class="page-side"></aside>
    </div>
</body>

</html>
