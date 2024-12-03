@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <div class="container page-parent product-detail">
        <main class="page-main">
            <div class="product-detail-top row">
                <div class="col">
                    <div class="product-images">
                        <img src="{{ asset('images/' . (Storage::exists('images/' . $item_image) ? $item_image : 'noimg.png')) }}"
                            alt="{{ $item->item_name }}">
                    </div>
                </div>
                <div class="col">
                    <form action="{{ route('carts.store') }}" method="post">
                        @csrf
                        <p class="category">{{ $item->category->category_name }}</p>
                        <div class="product-name">{{ $item->item_name }}</div>
                        <input type="hidden" name="item_id" value="{{ $item->id }}" required>
                        <p class="product-price">{{ number_format($item->item_price) }}<span>円（税込）</span></p>
                        <div class="row">
                            <div class="col-md-4">サイズ</div>
                            <div class="col-md-8">
                                <p>{{ $size_name }}</p>
                                @if ($errors->has('size'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('size') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">数量<span class="text-danger ms-3">*</span></div>
                            <div class="col-md-8">
                                <select class="form-select {{ $errors->has('quantity') ? 'is-invalid' : '' }}" name="quantity" aria-label="Default select example">
                                    <option value="" disabled {{ old('quantity') ? '' : 'selected' }}>選択してください</option>
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('quantity') == $i ? 'selected' : '' }}>
                                            {{ $i }}個</option>
                                    @endfor
                                </select>
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('quantity') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary submit" type="submit" name="action" value="cart">カートに入れる</button>
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
