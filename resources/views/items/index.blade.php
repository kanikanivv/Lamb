@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
    <div class="container page-parent product-list">
        <asid class="page-side">
            <div class="sideber d-flex flex-column flex-shrink-0 p-3" style="width: 240px;">
                <span class="fs-3 sidebar-title">性別</span>
                <hr>
                <ul class="nav nav-pills flex-column">
                    <li><a href="{{ route('items.index', ['gender_name' => 'すべて' ]) }}" class="nav-link">すべて</a></li>
                    <li><a href="{{ route('items.index', ['gender_name' => 'メンズ' ]) }}" class="nav-link">メンズ</a></li>
                    <li><a href="{{ route('items.index', ['gender_name' => 'レディース' ]) }}" class="nav-link">レディース</a></li>
                    <li><a href="{{ route('items.index', ['gender_name' => 'キッズ' ]) }}" class="nav-link">キッズ</a></li>
                </ul>
                <span class="fs-3 sidebar-title">カテゴリー</span>
                <hr>
                <ul class="nav nav-pills flex-column">
                    <li><a href="{{ route('items.index', ['category_name' => 'トップス']) }}" class="nav-link">トップス</a></li>
                    <li><a href="{{ route('items.index', ['category_name' => 'パンツ']) }}" class="nav-link">パンツ</a></li>
                    <li><a href="{{ route('items.index', ['category_name' => 'スカート']) }}" class="nav-link">スカート</a></li>
                    <li><a href="{{ route('items.index', ['category_name' => 'ジャケット']) }}" class="nav-link">ジャケット</a></li>
                    <li><a href="{{ route('items.index', ['category_name' => 'バッグ']) }}" class="nav-link">バッグ</a></li>
                    <li><a href="{{ route('items.index', ['category_name' => 'シューズ']) }}" class="nav-link">シューズ</a></li>
                </ul>
            </div>
        </asid>
        <main class="page-main">
            <div class="row card-list">
                <!-- card -->
                @forelse ($items as $item)
                    <div class="card g-col-3 g-col-md-12" style="width: 23rem;">
                        <a href="{{ route('items.show', ['id'=>$item->id]) }}">
                            <img src="{{ asset('images/noimg.png') }}" alt="{{ $item->item_name }}">
                        </a>
                        <div class="card-body"><a>
                            <h5 class="card-title">{{ $item->item_name }}</h5>
                            <p class="card-text">{{ $item->item_comment }}</p>
                        </a></div>
                    </div>
                @empty
                    <p>該当する商品はありません。</p>
                @endforelse
            </div>
            <!-- pager -->
            {{ $items->links() }}
        </main>
    </div>
@endsection
