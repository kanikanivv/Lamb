@extends('layouts.admin')

@section('title', '商品新規作成')

@section('content')

    <!-- main -->
    <main class="main">
        <!-- breadcrumb -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">カテゴリー一覧</li>
                <li class="breadcrumb-item active" aria-current="page">アイテム一覧</li>
                <li class="breadcrumb-item active" aria-current="page">アイテム編集</li>
            </ol>
        </nav>
        <!-- breadcrumb end -->
        <h1 class="mb-4">アイテム編集</h1>
        {{-- エラーメッセージ --}}
        @if ($errors->any())
            <div class=“alert alert-danger”>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <p><a href="{{ route('admin.categories.itemscategory.index') }}">戻る</a></p>
        <section>
            <form class="item-form" action="{{ route('admin.categories.itemscategory.update', $itemcategory->id )}}" method="POST">
                @csrf
                @method('PUT')
                <table class="table table-px">
                    <thead>
                        <tr class="table-gray">
                            <th scope="col">カテゴリー名</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="category_name" id="category_name" value="{{old('category_name') ?? $itemcategory->category_name}}" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-end-update"><button type="submit" class="btn update-btn-btn">更新する</button></div>
            </form>
        </section>
    </main>
    <!-- main end -->

@endsection
