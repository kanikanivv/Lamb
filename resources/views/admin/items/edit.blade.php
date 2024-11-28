@extends('layouts.admin')

@section('title', '商品詳細')

@section('content')
    <!-- main -->
    <main class="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.items.index') }}" class="text-dark">商品一覧</a></li>
                <li class="breadcrumb-item active" aria-current="page">商品詳細</li>
            </ol>
        </nav>
        {{-- breadcrumb end --}}
        <h1>商品詳細</h1>
        <p><a href="{{ route('admin.items.index') }}">戻る</a></p>
        <form action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="form-product-detail">
            @csrf
            @method('PUT')

            {{-- エラーメッセージ --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table-product-detail">
                <tr>
                    <th>商品名</th>
                    <td>
                        <input type="text" name="item_name" value="{{ old('item_name', $item->item_name) }}" class="form-control form-control-lg">
                    </td>
                </tr>
                <tr>
                    <th>単価</th>
                    <td>
                        <input type="text" name="item_price" value="{{ old('item_price', number_format($item->item_price)) }}" class="form-control form-control-lg">
                    </td>
                </tr>
                <tr>
                    <th>イメージ画像</th>
                    <td>
                        <!-- 複数の画像選択 -->
                        <input class="form-control form-control-lg mb-3" type="file" name="images[]" accept="image/*" id="formFile" multiple>

                        {{-- 既存の画像があれば表示 --}}
                        @if ($images->isNotEmpty())
                            @foreach ($images as $image)
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $item->item_name }}" class="mt-2" width="100">
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>アイテムカテゴリ</th>
                    <td>
                        <select name="item_category_id" class="form-select form-select-lg">
                            <option value="" disabled {{ old('item_category_id', $item->item_category_id) ? '' : 'selected' }}>選択されていません</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('item_category_id', $item->item_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>サイズ</th>
                    <td>
                        <select name="item_size_id" class="form-select form-select-lg">
                            <option value="" disabled {{ old('item_size_id', $item->item_size_id) ? '' : 'selected' }}>選択されていません</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}"
                                    {{ old('item_size_id', $item->item_size_id) == $size->id ? 'selected' : '' }}>
                                    {{ $size->size_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        <select name="item_gender_id" class="form-select form-select-lg">
                            <option value="" disabled {{ old('item_gender_id', $item->item_gender_id) ? '' : 'selected' }}>選択されていません</option>
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->id }}"
                                    {{ old('item_gender_id', $item->item_gender_id) == $gender->id ? 'selected' : '' }}>
                                    {{ $gender->gender_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>数量</th>
                    <td>
                        <select name="quantity" class="form-select form-select-lg">
                            <option value="20" {{ old('quantity', $item->quantity) == '20' ? 'selected' : '' }}>20個</option>
                        </select>
                    </td>
                </tr>
            </table>

            <div><button type="submit" class="btn update-btn">更新する</button></div>

            <p class="text-center mt-4"><a href="{{ route('admin.items.index') }}" class="text-decoration-none">キャンセル</a></p>
        </form>
    </main>
    <!-- main end -->
@endsection
