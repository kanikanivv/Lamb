@extends('layouts.admin')

@section('title', '商品新規作成')

@section('content')

<main class="main">
    <!-- breadcrumb -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">商品一覧</li>
        </ol>
    </nav>
    <!-- breadcrumb end -->
    <h1 class="mb-4">商品管理</h1>
    <!-- product list -->
    <div class="product-list">
        <div class="sign-up-btn"><a class="btn btn-primary" href="{{ route('admin.items.create') }}" role="button">新規登録</a></div>
        <!-- admin table -->
        <div class="admin-table">
            <!-- table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="admin-category-th">商品名</th>
                        <th scope="col" class="admin-category-th">お気に入り数</th>
                        <th scope="col" class="admin-category-th">購入商品数</th>
                        <th scope="col" class="admin-category-th">登録日</th>
                        <th scope="col" class="admin-category-th"></th>
                    </tr>
                </thead>
                <tbody>
                    <div class="category-item-class">
                        @foreach ($items as $item)

                        <tr>
                            <td class="admin-category-td"><a class="link-opacity-100" href="#">{{$item->item_name}}</a></td>
                            <td class="admin-category-td">1</a></td>
                            <td class="admin-category-td">1</a></td>
                            <td class="admin-category-td">{{$item->created_at}}</td>
                            <td class="item-btn admin-category-td">
                                <input class="btn btn-primary" type="button" value="削除">
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
    {{ $items->links() }}
</main>
@endsection
