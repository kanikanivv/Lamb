<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Gender;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class ItemsController extends Controller
{

//商品の表示
public function index(Request $request)
{
    $items = Item::orderby('created_at', 'desc')->Paginate(10);

    return view('admin.items.index', compact('items'));
}
    // /**
    //  * 商品の追加
    //  *
    //  * @return void
    //  */
    // public function create(Request $request): object
    // {
    //     $categories = Category::all();
    //     $sizes      = Size::all();
    //     $genders    = Gender::all();

    //     // POST送信したデータを取得して、itemテーブルに追加
    //     DB::table('items')->insert([
    //         'id'                => $request->input('id'),
    //         'item_category_id'  => $request->input('item_category_id'),
    //         'item_size_id'      => $request->input('item_size_id'),
    //         'item_gender_id'    => $request->input('item_gender_id'),
    //         'item_name'         => $request->input('item_name'),
    //         'item_price'        => $request->input('item_price'),
    //         'item_comment'      => $request->input('item_comment'),
    //     ]);

    //     return view('admin.items.create', compact('input', 'categories', 'sizes', 'genders'));
    // }
}
