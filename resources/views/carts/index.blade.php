@extends('layouts.app')
@section('title', 'カート')

@section('content')

    <div class="container page-parent">
        <main class="page-main carts-containt">
            <h2 class="mt-0">カート</h2>
            {{-- <form action="{{ route('order.') }}" method="POST" novalidate> --}}
                @if ($carts->isNotEmpty())
                    <div class="carts-block d-flex justify-content-between">
                        <!-- カート内商品 -->
                        <div class="carts-wrap">
                            @foreach ($carts as $cart)
                                <form action="{{ route('carts.destroy', ['id' => $cart->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="carts mb-5">
                                            <button class="btn btn-btn" type="submit" value="delete">
                                                <img src="{{ asset('images/Close.svg') }}" alt="">
                                            </button>
                                        <div class="card mb-3">
                                            <div class="d-flex justify-content-between carts-item">
                                                <div class="thumbnail">
                                                    <img src="{{ asset('images/noimg.png') }}" alt="">
                                                </div>
                                                <div class="detail">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $cart->item->item_name }}</h5>
                                                        <p class="card-text">単価 (税抜き) : {{ number_format($cart->item->item_price) }}円</p>
                                                        <p class="card-text">数量：{{ $cart->quantity }}個</p>
                                                        <p class="card-text">サイズ：{{ $cart->item->size->size_name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                        <!-- 請求金額 -->
                        <div class="total-price">
                            <div class="card text-center">
                                <div class="card-body">
                                    <p class="card-text item-price"><span>商品の小計
                                            :</span><span>{{-- $subtotal --}}</span></p>
                                    <p class="card-text service-price"><span>配送料・サービス料：</span><span>200円</span></p>
                                    <p class="card-text charge-amount">
                                        <span>ご請求額：</span><span>{{-- $total --}}</span>
                                    </p>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" value="送信">購入手続きに進む</button>
                        </div>
                    </div>
                @else
                    <p>カートが商品がありません。</p>
                @endif
            {{-- </form> --}}
        </main>
    </div>

@endsection
