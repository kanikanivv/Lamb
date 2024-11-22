<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * カート内商品を表示
     *
     * @return void
     */
    public function index()
    {
        //cartsテーブルのデータ取得
        $carts = Cart::with('item', 'category')
        ->where('user_id', \Auth::user()->id)
        ->orderBy('created_at', 'DESC')
        ->get();

        //合計金額の計算
        $total = $carts->reduce(function ($carry, $cart) {
            $cart->subtotal = $cart->item->tax_sales_prices * $cart->count;
            return $carry + $cart->subtotal;
        }, 0);
        $user = auth()->user();
        $total_count = $carts->sum('count'); //カート内の商品数の合計

        return view('carts.index', compact('carts', 'total', 'total_count', 'user'));
    }

    public function store(Request $request, Item $item) //Item $item -> Itemモデルを使ってDBから引数となるデータを取得し$itemに代入
    {
        // バリデーション
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1',
        ]);

        $action = $request->input('action'); //「カートに追加する」ボタンを押す

        if ($action === 'cart') {
            $user    = auth()->user();
            $item_id = $request->input('item_id');
            $count   = $request->input('count');

            // すでにカートに同じ商品があるか確認
            $existingCart = Cart::where('user_id', $user->id)
                ->where('item_id', $item_id)
                ->first();

            if ($existingCart) {
                $existingCart->count += $count;
                $existingCart->save();
                $request->session()->falsh('cartAdd', 'カートに商品を追加しました');
                return back();
            } else {
                // カートに新しいアイテムを追加
                Cart::create([
                    'user_id' => $user->id
                ]);
            }
        }


    }
}
