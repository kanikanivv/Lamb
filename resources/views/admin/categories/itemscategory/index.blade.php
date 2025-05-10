@extends('layouts.admin')

@section('title', '商品新規作成')

@section('content')

    <!-- main -->
    <main class="main">
        <!-- breadcrumb -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">カテゴリー管理</li>
                <li class="breadcrumb-item active" aria-current="page">アイテム一覧</li>
            </ol>
        </nav>
        <!-- breadcrumb end -->
        <h1 class="mb-4">アイテム一覧</h1>
        @if (session('create'))
            <div class="alert-blue-line mb-2">
                {{ session('create') }}
            </div>
        @endif
        <p><a href="{{ route('admin.categories.index') }}">戻る</a></p>
        <section>

            <table class="table table-px">
                <thead>
                    <form action="{{ route('admin.categories.itemscategory.create')}}" method="GET">
                        <div class="text-end">
                            <button type="submit" class="btn btn-update-btn">新規登録</button>
                        </div>
                    </form>
                    <tr class="table-gray">
                        <th scope="col">カテゴリー名</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemcategories as $itemcategory)
                        <tr>
                            <td class="admin-category-td">
                                {{ $itemcategory->category_name }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.categories.itemscategory.edit', $itemcategory->id) }}"
                                    method="get">
                                    @csrf
                                    <button type="submit" class="btn edit-btn">編集</button>
                                </form>
                            </td>
                            <td class="text-end">
                            <form action="{{ route('admin.categories.itemscategory.destroy', $itemcategory->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn red-delete-btn"  onclick='return confirm("本当に削除しますか？")'>削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </section>
    </main>
    <!-- main end -->

@endsection
