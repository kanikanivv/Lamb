<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        //カートテーブルの取得
        $carts = Cart::all();

        return view('carts.index', compact('carts'));
    }

    public function store(Requests $request, Item $item)
    {
        //ボタンを押すと追加処理
        $action = $repuest->input('action');

        $itemId = $request->input('item_id');
        $count = $request->input('count');

        $cart = session()->get('cart', []);
        $cart[$itemId] = [
            'name' => $item->name,
            'price' => $item->price,
        ];
        session()->put('cart', $cart);
    }
 }
