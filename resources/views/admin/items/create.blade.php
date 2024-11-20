@extends('layouts.admin')

@section('title', '商品新規作成')

@section('content')
    <!-- main -->
    <main class="main">
        <!-- breadcrumb -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="product.html" class="text-dark">管理一覧</a></li>
                <li class="breadcrumb-item"><a href=".html" class="text-dark">商品一覧</a></li>
                <li class="breadcrumb-item active" aria-current="page">商品詳細</li>
            </ol>
        </nav>
        <!-- breadcrumb end -->
        <h1>商品詳細</h1>
        <p class="mb-3">2024/10/10</p>
        <form action="" method="post" class="form-product-detail">
            <!-- ディレクティブでCSRFを指定 -->
            @csrf

            <table class="table-product-detail">
                <tr>
                    <th>商品名</th>
                    <td>
                        <input type="text" value="item_name" class="form-control form-control-lg">
                    </td>
                </tr>
                <tr>
                    <th>単価</th>
                    <td>
                        <input type="text" value="item_price" class="form-control form-control-lg">
                    </td>
                </tr>
                <tr>
                    <th>イメージ画像</th>
                    <td>
                        <input class="form-control form-control-lg mb-3" type="file" id="formFile" accept="image/*">
                        <img src="images/noimg.png" alt="">
                    </td>
                </tr>
                <tr>
                    <th>アイテム</th>
                    <td>
                        <select name="item-categories" id="" class="form-select form-select-lg"
                            aria-label=".form-select-lg">
                            <option selected>選択されていません</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>サイズ</th>
                    <td>
                        <select name="item-size" id="" class="form-select form-select-lg"
                            aria-label=".form-select-lg">
                            <option selected>選択されていません</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        <select name="gender" id="" class="form-select form-select-lg"
                            aria-label=".form-select-lg">
                            <option selected>選択されていません</option>
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->gender_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
            <div><button type="submit" class="btn update-btn">更新する</button></div>
            <p class="text-center mt-4"><a href="{{ route(admin.items.index) }}" class="text-decoration-none">キャンセル</a></p>
        </form>
    </main>
    <!-- main end -->
@endsection
