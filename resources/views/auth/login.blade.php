@extends('layouts.app')

@section('content')
    <div class="container page-parent login">
        <main class="page-main">
            <div class="login-block">
                <section class="login-form-sec">
                    <h2 class="mt-0"><strong>{{ __('ログイン') }}</strong></h2>

                    <form method="POST" action="{{ route('login') }}" class="form-login">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('メールアドレス') }}</label>
                            <input id="exampleInputEmail1" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="メールアドレスを入力してください" name="email" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword" class="form-label">{{ __('パスワード') }}</label>
                            <input id="exampleInputPassword" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="パスワードを入力してください" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="login-btn btn">
                            {{ __('ログイン') }}
                        </button>
                    </form>
                </section>
                <section>
                    <h2 class="mt-0"><strong>{{ __('会員登録がまだの方はこちら') }}</strong></h2>
                    <div class="text-center"><a href="{{ route('register') }}"><input class="registration-btn btn" value="新規会員登録（無料）"></a></div>
                </section>
            </div>
        </main>
    </div>
@endsection
