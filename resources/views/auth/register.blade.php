@extends('layouts.app')

@section('content')

    <div class="container page-parent">
        <div class="membership">
            <main class="page-main" style="margin-bottom:4rem;">

                <h2><strong>{{ __('会員登録') }}</strong></h2>
                <form action="{{ route('register') }}" method="POST" >
                    @csrf

                    <div class="second-membership">
                        <div class="form-group email">
                            <label for="exampleInputEmail">{{ __('メールアドレス') }}</label>
                            <input id="exampleInputEmail" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="メールアドレスを入力してください" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="exampleInputPassword">{{ __('パスワード') }}</label>
                            <input id="exampleInputPassword" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="パスワードを入力してください" value="{{ old('password') }}" required autocomplete="password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                            <label for="formGroupExampleInput">{{ __('氏名') }}</label>
                            <input id="formGroupExampleInput" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="氏名を入力してください" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput">{{ __('ユーザ名') }}</label>
                            <input id="formGroupExampleInput" type="text"
                                class="form-control @error('user_name') is-invalid @enderror" name="user_name"
                                placeholder="ユーザ名を入力してください" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                            @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="formGroupExampleInput">{{ __('電話番号') }}</label>
                            <input id="formGroupExampleInput" type="text"
                                class="form-control @error('tel') is-invalid @enderror" name="tel"
                                placeholder="電話番号を入力してください" required autocomplete="tel" autofocus>
                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                            <label for="formGroupExampleInput">{{ __('住所') }}</label>
                            <input id="formGroupExampleInput" type="text"
                                class="form-control @error('address') is-invalid @enderror" name="address"
                                placeholder="住所を入力してください" required autocomplete="address" autofocus>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group select">
                            <label for="exampleFormControlSelect1">年齢</label>
                            <select name="age" class="form-control" id="exampleFormControlSelect1">
                                <option value="20" selected>
                                    20
                                </option>
                                @for ($i = 21; $i < 100; $i++)
                                <option value="21">
                                    {{ $i }}
                                </option>
                                @endfor

                            </select>
                        </div>

                        <div></div>
                                <div class="alert alert-primary" role="alert"> 規約および <a href="#" class="alert-link">個人情報保護方針</a>への同意が必要です。</div>
                            </div>

                        <div class="members-btn">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('同意して次へ') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
@endsection
