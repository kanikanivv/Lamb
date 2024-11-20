<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Gender;
use App\Models\Category;
use App\Models\Size;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ItemsController extends Controller
{
    /**
     * カテゴリー別商品一覧を表示
     *
     * @param Request $request
     * @param [type] $gender_name
     * @return view
     */
    public function index(Request $request, $gender_name = null, $category_name = null): view
    {

        // 性別パラメータを取得
        $gender_name   = $gender_name ?? $request->get('gender_name', 'すべて');

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
        $item          = Item::find($id);
        $category_name = Category::where('category_name', $id);

        return view('items.show', compact('item'));
    }

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

        // POST送信したデータを取得して、itemテーブルに追加
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

    /**
     * 購入完了画面を表示
     *
     * @return void
     */
    public function done()
    {
        return view('items.thanks');
    }
}
