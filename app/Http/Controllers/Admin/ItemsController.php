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
//  * 商品の新規登録画面表示
//  *
//  * @return void
//  */
// public function create(Request $request): object
// {
    //     $categories = Category::all();
    //     $sizes      = Size::all();
    //     $genders    = Gender::all();

    //     return view('admin.items.create');

    // }

    //
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // 商品を削除
        $item->delete();

 return redirect()->route('admin.items.index')->with('delete', '商品が削除されました。');
}

}
