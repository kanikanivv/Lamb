@extends('layouts.admin')

@section('title', '商品新規作成')

@section('content')

<main class="main">
    <!-- breadcrumb -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">カテゴリー管理</li>
        </ol>
    </nav>
    <!-- breadcrumb end -->
    <h1 class="mb-4">カテゴリー一覧</h1>
    <!-- product list -->
    <div class="product-list">
        <!-- admin table -->
        <div class="admin-table">
            <!-- table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="admin-category-th">カテゴリー名</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="category-item-class">
                        <tr>
                            <td class="admin-category-td"><a href="{{ route('admin.categories.itemscategory.index') }}" class="nav-link">アイテム</a></td>
                            </td>
                        </tr>
                        <tr>
                            <td class="admin-category-td"><a href="{{ route('admin.categories.sizes.index') }}" class="nav-link">サイズ</a></td>
                            </td>
                        </tr>
                        <tr>
                            <td class="admin-category-td"><a href="{{ route('admin.categories.genders.index') }}" class="nav-link">性別</a></td>
                            </td>
                        </tr>
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
