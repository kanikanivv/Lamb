<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Gender;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ItemsController extends Controller
{
    /**
     * 商品一覧を表示
     *
     * @param Request $request
     * @param [type] $gender_name
     * @return view
     */
    public function index(Request $request, $gender_name = null, $category_name = null): view
    {

        // 性別パラメータを取得
        $gender_name = $gender_name ?? $request->get('gender_name', 'すべて');

        // カテゴリーパラメータを取得
        $category_name = $category_name ?? $request->get('category_name', 'すべて');

        //初期クエリ
        $query = Item::query();

        // 性別フィルタ
        if ($gender_name !== 'すべて') {
            $gender = Gender::where('gender_name', $gender_name)->first();
            if ($gender) {
                $query->where('item_gender_id', $gender->id);
            }
        }

        // カテゴリーフィルタ
        if ($category_name !== 'すべて') {
            $category = Category::where('category_name', $category_name)->first();
            if ($category) {
                $query->where('item_category_id', $category->id);
            }
        }

        // 商品の取得
        $items = $query->paginate(20);

        return view('items.index', compact('items', 'gender_name', 'category_name'));
    }

    /**
     * 商品詳細を表示
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        $item = Item::find($id);
        $category_name = Category::where('category_name', $id);
        return view('items.show', compact('item'));
    }

    public function thanks()
    {
        return view('items.thanks');
    }
}
