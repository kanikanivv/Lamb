@extends('layouts.app')

@section('title', '購入完了')

@section('content')
    <div class="container page-parent purchase-complete-container">
        <main class="page-main">
            <div class="purchase-complete-top">
                <div class="purchase-complete-top-block">
                    <p class="fs-4 mb-3">購入ID</p>
                    <p class="fs-1 lh-1 mb-4"><b>0000-0000-0000</b></p>
                    <p class="fs-2 lh-1 mb-3"><b>ご注文、ありがとうございます</b></p>
                    <p class="fs-4 lh-2">お問い合わせ時に、<br>こちらの番号をお伺いする場合がございます。<br>お手元に保存をお願いいたします。</p>
                </div>
            </div>
            <div class="purchase-complete-bottom">
                <div class="complete-btn"><a href="{{ route('items.index') }}" type="button" class="btn btn-primary">トップへ戻る</a></div>
            </div>
        </main>
    </div>
@endsection
