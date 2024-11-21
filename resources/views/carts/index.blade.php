@extends('layouts.app')
@section('title', 'カート')

@section('content')

        <div class="container page-parent">
            <main class="page-main carts-containt">
                <h2 class="mt-0">カート</h2>
                <form action="" method="POST" novalidate>
                    <div class="carts-block d-flex justify-content-between">
                        <!-- カート内商品 -->
                        <div class="carts-wrap">
                            <div class="carts mb-5">
                                <button class="btn btn-btn" type="submit">
                                    <img src="images/Close.svg" alt="">
                                </button>
                                <div class="card mb-3">
                                    <div class="d-flex justify-content-between carts-item">
                                        <div class="thumbnail">
                                            <img src="images/noimg.png" alt="">
                                        </div>
                                        <div class="detail">
                                            <div class="card-body">
                                                <h5 class="card-title"></h5>
                                                <p class="card-text">単価 (税抜き) : 200</p>
                                                <p class="card-text">数量：1</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 請求金額 -->
                        <div class="total-price">
                            <div class="card text-center">
                                <div class="card-body">
                                    <p class="card-text item-price"><span>商品の小計 :</span><span>2000円</span></p>
                                    <p class="card-text service-price"><span>配送料・サービス料：</span><span>2000円</span></p>
                                    <p class="card-text charge-amount"><span>ご請求額：</span><span>2000円</span></p>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" value="送信">購入手続きに進む</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>

@endsection
