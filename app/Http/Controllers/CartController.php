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

        //合計金額の計算

        return view('carts.index', compact('carts'));
    }

    /**
     * カート内商品を削除
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $cart_item = Cart::findOrFail($id);
        $cart_item->delete();

        return redirect()->route('carts.index');
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
            'user_id'  => 'required|exists:users.id',
            'item_id'  => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $action = $request->input('action'); //「カートに追加する」ボタンを押す

        if ($action === 'cart') { //「カートに追加する」ボタンのvalue値
            $user_id   = Auth::id();
            $item_id   = $request->input('item_id');
            $quantity  = $request->input('quantity');

            // すでにカートに同じ商品があるか確認
            $existingCart = Cart::where('user_id', $user_id)
                ->where('item_id', $item_id)
                ->first();

            if ($existingCart) {
                $existingCart->quantity += $quantity;
                $existingCart->save();
                return redirect()->route('items.show', ['id' => $item_id]);
            } else {
                // カートに新しいアイテムを追加
                Cart::create([
                    'user_id'  => $user_id,
                    'item_id'  => $item_id,
                    'quantity' => $quantity,
                ]);
                return redirect()->route('items.show', ['id' => $item_id]);
            }
        }
    }
}
