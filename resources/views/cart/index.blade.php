@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="container">
    <h1>カート</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>商品</th>
                    <th>数量</th>
                    <th>価格</th>
                    <th>合計</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $productId => $item)
                    <tr>
                        <td>{{ $item['product'] }}</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                <button type="submit">更新</button>
                            </form>
                        </td>
                        <td>{{ $item['price'] }}円</td>
                        <td>{{ $item['price'] * $item['quantity'] }}円</td>
                        <td>
                            <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>合計金額: {{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart'))) }}円</h3>
    @else
        <p>カートには商品がありません。</p>
    @endif
</div>
@if(isset($product))
<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product" value="{{ $product->id }}">
    <input type="hidden" name="price" value="{{ $product->price }}">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit">カートに追加</button>
</form>
@endif
@endsection
