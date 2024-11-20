<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Gender;
use App\Models\Category;
use App\Models\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemContoroller extends Controller
{
    /**
     * 商品の追加
     *
     * @return void
     */
    public function create(Request $request): object
    {
        $categories = Category::all();
        $sizes      = Size::all();
        $genders    = Gender::all();

        // POST送信したデータを取得して、itemsテーブルに追加
        DB::table('items')->insert([
            'id'                => $request->input('id'),
            'item_category_id'  => $request->input('item_category_id'),
            'item_size_id'      => $request->input('item_size_id'),
            'item_gender_id'    => $request->input('item_gender_id'),
            'item_name'         => $request->input('item_name'),
            'item_price'        => $request->input('item_price'),
            'item_comment'      => $request->input('item_comment'),
        ]);

        return view('admin.items.create', compact('input', 'categories', 'sizes', 'genders'));
    }
}
