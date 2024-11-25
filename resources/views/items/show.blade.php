@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <div class="container page-parent product-detail">
        <main class="page-main">
            <div class="product-detail-top row">
                <div class="col">
                    <div class="product-images">
                        <img src="{{ asset('images/test.png') }}" alt="">
                        <img src="{{ asset('images/test.png') }}" alt="">
                        <img src="{{ asset('images/test.png') }}" alt="">
                        <img src="{{ asset('images/test.png') }}" alt="">
                    </div>
                </div>
                <div class="col">
                    <p class="category">{{$item->category->category_name}}</p>
                    <div class="product-name">{{$item->item_name}}</div>
                    <p class="product-price">{{ number_format($item->item_price) }}<span>円（税込）</span></p>
                    <div class="row">
                        <div class="col-md-4 mb-3">数量</div>
                        <div class="col-md-8">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>選択してください</option>
                                <option value="1">20個</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">サイズ</div>
                        <div class="col-md-8">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>選択してください</option>
                                <option value="1">S</option>
                                <option value="2">M</option>
                                <option value="3">L</option>
                            </select>
                        </div>
                    </div>

                    <input class="btn btn-primary submit" type="button" value="カートに入れる" name="action">
                </div>
            </div>

            <div class="product-detail-bottom">
                <h2 class="product-explanation">商品説明</h2>
                <p>{{ $item->item_comment }}</p>
                <h2>カスタマーレビュー</h2>
                <div class="row">
                    <div class="col-md-6 mb-3col-md-4">
                        <p>匿名ユーザさん</p>
                        <p>文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。</p>
                    </div>
                    <div class="col-md-6 mb-3col-md-4">
                        <p>匿名ユーザさん</p>
                        <p>文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。文章が入ります。</p>
                    </div>
                </div>
            </div>
        </main>
        <aside class="page-side"></aside>
    </div>
@endsection
