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
                    <form action="{{ route('carts.store') }}" method="post">
                        @csrf
                        <p class="category">{{ $item->category->category_name }}</p>
                        <div class="product-name">{{ $item->item_name }}</div>
                        <input type="hidden" name="item_id" value="{{ $item->id }}" required>
                        <p class="product-price">{{ number_format($item->item_price) }}<span>円（税込）</span></p>
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">数量</div>
                            <div class="col-md-8">
                                <select class="form-select" value="count" aria-label="Default select example">
                                    <option value="" disable {{ old('count') ? '' : 'selected' }}>選択してください</option>
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('count') == $i ? 'selected' : '' }}>
                                            {{ $i }}個</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">サイズ</div>
                            <div class="col-md-8">
                                <select class="form-select" value="size_name" aria-label="Default select example">
                                    <option disable {{ old('size') ? '' : 'selected' }}>選択してください</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}" {{ old('size') == $i ? 'selected' : '' }}>
                                            {{ $size->size_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input class="btn btn-primary submit" type="submit" value="カートに入れる" name="action" value="cart">
                    </form>
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
