@extends('layouts.admin')

@section('title', '商品新規作成')

@section('content')

<main class="main">
    <!-- breadcrumb -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">カテゴリー管理</li>
            <li class="breadcrumb-item active" aria-current="page">サイズ一覧</li>
        </ol>
    </nav>
    <!-- breadcrumb end -->
    <h1 class="mb-4">サイズ一覧</h1>
    <p><a href="{{ route('admin.categories.index') }}">戻る</a></p>
    <!-- product list -->
    <div class="product-list">
        <!-- admin table -->
        <div class="admin-table">
            <!-- table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="admin-category-th">サイズ名</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="category-item-class">
                        @foreach ($sizes as $size)
                        <tr>
                            <td class="admin-category-td">{{ $size->size_name }}</td>
                            </td>
                        </tr>
                        @endforeach
                    </div>
                </tbody>
            </table>
        </div>
        <!-- table end -->
    </div>
    <!-- admin table end -->
    <!-- product list end -->
    <!-- pager -->
</main>
@endsection
