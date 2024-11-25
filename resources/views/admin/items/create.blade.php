@extends('layouts.admin')

@section('title', '商品新規作成')

@section('content')
    <!-- main -->
    <main class="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.items.index') }}" class="text-dark">商品一覧</a></li>
                <li class="breadcrumb-item active" aria-current="page">商品新規作成</li>
            </ol>
        </nav>
        {{-- breadcrumb end --}}
        <h1>商品新規作成</h1>
        <p class="mb-3">{{ now()->format('Y/m/d') }}</p>
        <form action="{{ route('admin.items.store') }}" method="post" enctype="multipart/form-data" class="form-product-detail">
            @csrf
            {{-- エラーメッセージ --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table-product-detail">
                <tr>
                    <th>商品名</th>
                    <td>
                        <input type="text"name="item_name" value="{{ old('item_name') ?? '' }}"
                            class="form-control form-control-lg">
                    </td>
                </tr>
                <tr>
                    <th>単価</th>
                    <td>
                        <input type="text" name="item_price" value="{{ old('item_price') ?? '' }}"
                            class="form-control form-control-lg">
                    </td>
                </tr>
                <tr>
                    <th>イメージ画像</th>
                    <td>
                        <input class="form-control form-control-lg mb-3" type="file" name="images[]" value="{{ old('image_path') }}" id="formFile" accept="image/*" max="4">
                        @freoreach($item->imahes as $image)

                        <img src="{{ old('image') }}" alt="" width="200">
                    </td>
                </tr>
                <tr>
                    <th>アイテム</th>
                    <td>
                        <select name="item-categories_id" id="" class="form-select form-select-lg"
                            aria-label=".form-select-lg">
                            <option value="" disable {{ old('item_categories_id') ? '' : 'selected' }}>選択されていません</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('item_categories_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>サイズ</th>
                    <td>
                        <select name="item-size_id" id="" class="form-select form-select-lg"
                            aria-label=".form-select-lg">
                            <option value="" disable {{ old('item-size_id') ? '' : 'selected' }}>選択されていません</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}"
                                    {{ old('item_categories_id') == $size->id ? 'selected' : '' }}>
                                    {{ $size->size_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        <select name="item_gender_id" id="" class="form-select form-select-lg"
                            aria-label=".form-select-lg">
                            <option value="" disable {{ old('item_gender_id') ? '' : 'selected' }}>選択されていません</option>
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->id }}"
                                    {{ old('item_gender_id') == $gender->id ? 'selected' : '' }}>
                                    {{ $gender->gender_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
            <div><button type="submit" class="btn update-btn">更新する</button></div>
            <p class="text-center mt-4"><a href="{{ route('admin.items.index') }}" class="text-decoration-none">キャンセル</a>
            </p>
        </form>
    </main>
    <!-- main end -->
@endsection
