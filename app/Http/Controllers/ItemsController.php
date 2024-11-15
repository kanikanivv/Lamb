<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemsController extends Controller
{
    public function index()
    {
        // $items = Item::all();
        // return view('items.index', compact('items')); //変数$itemsをviewに渡す
    }

    public function show($id)
    {

        // 商品を取得
        $item = Item::find($id);

        // 商品が属する性別カテゴリーを取得
        $gender = $item->gender_name;

        //性別に基づいてデータを取得
        if ($gender == 'メンズ') {
            $itemDate = Item::where('item_gender_id', 1)->get();
        } elseif ($gender == 'レディース') {
            $itemDate = Item::where('item_gender_id', 2)->get();
        } elseif ($gender == 'キッズ') {
            $itemDate = Item::where('item_gender_id', 3)->get();
        } else {
            $itemDate = Item::all();
        }

        return view('items.index', compact('item', 'itemDate'));
    }

}
