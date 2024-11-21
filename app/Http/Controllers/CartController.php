<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * カートの一覧を表示
     */
    public function index(Request $request)
    {
        //カートテーブルの取得
        $carts = $request->session()->get('cart', []);

        return view('carts.index', ['cart' => $carts]);
    }

    /**
     * 商品をカートに追加する
     */
    public function store(Requests $request, $id)
    {
        $item = Item::find($id);

        // セッションからカート情報を取得する
        $cart = $request->session()->get('cart', []);

        // カートに商品を追加する
        $cart[$item->id] = [
            'item_name'     => $item->item_name,
            'item_price'    => $item->item_price,
            'quantity' => 1, // 初期数量を1にする
        ];

        // カート情報をセッションに保存する
        $request->session()->put('cart', $cart);

        return redirect()->route(carts.index);
    }
 }
