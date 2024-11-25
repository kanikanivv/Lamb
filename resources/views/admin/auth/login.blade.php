@extends('layouts.admin')

@section('content')
<div class="container page-parent container-admin-login">
    <main class="page-main">
        <div class="admin-login-block">
            <section class="login-form-sec">
                <div class="admin-title">Lamb</div>
                <form class="admin-form-login">
                    <div class="mb-3 admin-form">
                        <label for="exampleInputEmail1" class="admin-form-label">メールアドレス</label>
                        <input type="email" class="form-control admin-form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="メールアドレスを入力してください">
                    </div>
                    <div class="mb-3 admin-form">
                        <label for="exampleInputPassword1" class="admin-form-label">パスワード</label>
                        <input type="password" class="form-control admin-form-control" id="exampleInputPassword1" placeholder="パスワードを入力してください">
                    </div>
                    <div class="admin-btn"><button type="submit" class="login-btn btn">ログイン</button></div>
                </form>
            </section>
        </div>
    </main>
    <aside class="page-side"></aside>
</div>
@endsection
