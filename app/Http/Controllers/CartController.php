<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use App\Models\User;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
        $total = $carts->reduce(function ($carry, $cart) {
            // dd($cart->item->item_price);
            // dd($cart->count);
                $subtotal = $cart->item->item_price * $cart->count;
            return $carry + $subtotal;
        }, 0);


        $user = auth()->user();
        $total_count = $carts->sum('count'); //カート内の商品数の合計

        return view('carts.index', compact('carts', 'total', 'total_count'));
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
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインが必要です');
        }

        // dd('Before Action'); // アクションが呼ばれるかを確認
        //バリデーション
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'count'   => 'required|integer|min:1',
        ]);

        // dd($request->all());

        $action = $request->input('action'); //「カートに追加する」ボタンを押す

       // dd('Action:', $action);// $action の値を確認

        if ($action === 'cart') { //「カートに追加する」ボタンのvalue値
            $user    = Auth::user();
            $item_id = $request->input('item_id');
            $count   = $request->input('count');
            // dd($count);

            // すでにカートに同じ商品があるか確認
            $existingCart = Cart::where('user_id', $user->id)
                ->where('item_id', $item_id)
                ->first();

            if ($existingCart) {
                $existingCart->count += $count;
                $existingCart->save();
                return to_route('items.show', ['id' => $item_id]);
            } else {
                // カートに新しいアイテムを追加
                Cart::create([
                    'user_id' => $user->id,
                    'item_id' => $item_id,
                    'count'   => $count,
                ]);
                return to_route('items.show', ['id' => $item_id])->with('success', 'アイテムがカートに追加されました');
            }
        }
    }

    public function destroy($id)
{
    // カートのアイテムを取得
    $cart = Cart::find($id);

    if ($cart) {
        // カートアイテムが存在する場合は削除
        $cart->delete();
    }

    // 削除後にカート画面にリダイレクト
    return redirect()->route('carts.index')->with('success', 'アイテムが削除されました');
}
}
