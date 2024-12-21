@extends('layouts.app')
@section('title', 'カート')

@section('content')

    <div class="container page-parent">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <main class="page-main carts-containt">
            <h2 class="mt-0">お届け先</h2>
            <div class="carts-layout d-flex justify-content-between">
                <!-- お届け先 -->
                <div class="purchasing-settings">
                    <div class="item-delivary">
                        <div class="card mb-3  delivary-address" style="max-width: 540px;">
                            <div class="no-gutters">
                                <p class="card-text company-information">会員情報と同じお届け先</p>
                                <h5 class="user-name">{{ $user->name }}</h5>
                                <p class="card-text user-address">{{ $user->address }}</p>
                                <p class="card-text user-tel"><span>電話番号：</span><span>{{ $user->tel }}</span></p>
                            </div>
                        </div>
                    </div>
                    <h2>支払方法</h2>
                    @if (!empty($cardList))
                        <form action="{{ route('orders.payment') }}" method="POST">
                            @csrf
                            <div class="item-delivary">
                                <div class="card mb-3  delivary-address" style="max-width: 540px;">
                                    @foreach ($cardList as $card)
                                        <div class="no-gutters">
                                            <label>
                                                <input type="radio" name="payjp_card_id" value="{{ $card['id'] }}" />
                                                <span class="user-name">{{ $card['brand'] }} |
                                                    {{ $card['cardNumber'] }}</span>
                                                <p class="card-text user-address">名義: {{ $card['name'] }}</p>
                                                <p class="card-text user-tel">
                                                    有効期限は{{ $card['exp_year'] }}/{{ $card['exp_month'] }}です</p>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-secondary btn-lg btn-block">選択したカードで決済する</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('orders.createCharge') }}" method="POST">
                            @csrf
                            <div class="card mb-3  delivary-address" style="max-width: 540px;">
                                <script src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ config('payjp.public_key') }}"
                                    data-text="カード情報を入力" data-submit-text="カードを登録する"></script>
                            </div>
                        </form>
                    @endif
                </div>
                <!-- 請求金額 -->
                <div class="total-price">
                    <div class="card text-center">
                        <div class="card-body">
                            <p class="card-text item-price"><span>商品の小計
                                    :</span><span>{{ $total }} 円</span></p>
                            <p class="card-text service-price"><span>配送料・サービス料：</span><span>200円</span></p>
                            <p class="card-text charge-amount">
                                <span>ご請求額：</span><span>{{ $total + 200 }} 円</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>


@endsection
