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

class ItemsCategoryController extends Controller
{

    //商品の表示
    public function index(Request $request)
    {
        $itemcategories = Category::all();
        return view('admin.categories.itemscategory.index', compact('itemcategories'));
    }

    //編集画面の表示
    public function edit($id)
    {
        $itemcategory = Category::findOrFail($id);
        return view('admin.categories.itemscategory.edit', compact('itemcategory'));
    }

    //アイテム更新処理
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string:60'
        ]);
        $itemcategory = Category::findOrFail($id);
        $itemcategory->category_name = $request->input('category_name');
        $itemcategory->save();
        return redirect()->route('admin.categories.itemscategory.index', compact('itemcategory'))->with('create', 'アイテム情報が更新されました');
    }
    /**
     * 商品の新規登録画面表示
     *
     * @return void
     */
    public function create(Request $request): object
    {
        $categories = Category::all();
        return view('admin.categories.itemscategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|max:60',
        ]);

        $itemcategory = new Category;
        // $itemcategory->id = auth()->user()->id;
        $itemcategory->category_name = $request->input('category_name');
        $itemcategory->save();

        return redirect(route('admin.categories.itemscategory.index', compact('itemcategory')))->with('create', 'アイテムを追加しました');
    }

    public function destroy($id)
    {
        $item = Category::findOrFail($id);

        // 商品を削除
        $item->delete();

        return redirect()->route('admin.categories.itemscategory.index');
    }
}
