@extends('layouts.app')

<<<<<<< HEAD
@section('content')
<div class="container page-parent product-list">
    <aside class="page-side">
        <div class="sideber d-flex flex-column flex-shrink-0 p-3" style="width: 240px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
              <span class="fs-3 sidebar-title">性別</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column">
                <li><a href="#" class="nav-link">すべて</a></li>
                <li><a href="#" class="nav-link">メンズ</a></li>
                <li><a href="#" class="nav-link">レディース</a></li>
                <li><a href="#" class="nav-link">キッズ</a></li>
            </ul>
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                <span class="fs-3 sidebar-title">カテゴリー</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column">
                <li><a href="#" class="nav-link">Home</a></li>
                <li><a href="#" class="nav-link">トップス</a></li>
                <li><a href="#" class="nav-link">パンツ</a></li>
                <li><a href="#" class="nav-link">スカート</a></li>
                <li><a href="#" class="nav-link">ジャケット</a></li>
                <li><a href="#" class="nav-link">バッグ</a></li>
                <li><a href="#" class="nav-link">シューズ</a></li>
            </ul>
        </div>
    </aside>
    <main class="page-main">
        <div class="row card-list">
            <!-- card -->
            <div class="card g-col-3 g-col-md-12" style="width: 23rem;">
                <a href="">
                    <img src="images/noimg.png" alt="">
                </a>
                <div class="card-body"><a>
                    <h5 class="card-title">商品名が入ります</h5>
                    <p class="card-text">商品説明や値段が入ります。商品説明や値段が入ります。</p>
                </a></div>
            </div>
            <!-- card end -->
        </div>
        <!-- navigation -->
        <nav aria-label="Page navigation example lamb-pagenatioin">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </main>
</div>
=======
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
>>>>>>> feature/202411/sekiya
@endsection
