<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * カート内商品を表示
     *
     * @return void
     */
    public function index()
    {
        $user_id = Auth::id();

        // itemがnullでないカートアイテムのみ取得
        $carts = Cart::with('item', 'user')
        ->where('user_id', $user_id)
        ->whereHas('item')
        ->get();

        // //合計金額の計算
        // $total = $carts->reduce(function ($carry, $cart) {
        //     $cart->subtotal = $cart->item->tax_sales_prices * $cart->count;
        //     return $carry + $cart->subtotal;
        // }, 0);
        // $user = auth()->user();
        // $total_count = $carts->sum('count'); //カート内の商品数の合計

        return view('carts.index', compact('carts'));
    }


    /**
     * カートに商品を追加
     *
     * @param Request $request
     * @param Item $item
     * @return void
     */
    public function store(Request $request): RedirectResponse
    {
        // バリデーション
        $request->validate([
            'user_id' => 'required|exists:user_id',
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1',
        ]);

        $action = $request->input('action'); //「カートに追加する」ボタンを押す

        if ($action === 'cart') { //「カートに追加する」ボタンのvalue値
            $user    = Auth::user();
            bb($user);
            $item_id = $request->input('item_id');
            $count   = $request->input('count');

            // すでにカートに同じ商品があるか確認
            $existingCart = Cart::where('user_id', $user->id)
                ->where('item_id', $item_id)
                ->first();

            if ($existingCart) {
                $existingCart->count += $count;
                $existingCart->save();
                return to_route('items.show');
            } else {
                // カートに新しいアイテムを追加
                Cart::create([
                    'user_id' => $user->id,
                    'item_id' => $item_id,
                    'count'   => $count,
                ]);
                return to_route('items.show');
            }
        }
    }
}
