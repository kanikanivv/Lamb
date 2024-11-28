<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Category;
use App\Models\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class ItemsController extends Controller
{

    /**
     * 商品一覧の表示
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $items = Item::orderby('created_at', 'desc')->Paginate(10);

        return view('admin.items.index', compact('items'));
    }


    /**
     * 商品の新規作成画面を表示
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::orderBy('id')->get();
        $sizes      = Size::orderBy('id')->get();
        $genders    = Gender::orderBy('id')->get();

        // エラーハンドリング
        if ($categories->isEmpty() || $sizes->isEmpty() || $genders->isEmpty()) {
            return direct()->route('admin.items.index')->with('erroe', '必要なデータが見つかりませんでした');
        }
        return view('admin.items.create', compact('categories', 'sizes', 'genders'));
    }


    /**
     * 商品の新規作成画面で商品を保存
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // バリデーション
        $validated = $request->validate([
            'item_category_id'  => 'required|integer|exists:categories,id',
            'item_size_id'      => 'required|integer|exists:sizes,id',
            'item_gender_id'    => 'required|integer|exists:genders,id',
            'item_name'         => 'required|string|max:20',
            'item_price'        => 'required|numeric|min:0',
            'item_comment'      => 'nullable|string|max:1000',
            'quantity'          => 'nullable|numeric|min:0',
            'images'            => 'array|max:4',
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 商品の保存
        $item = new Item();
        $item->item_category_id = $validated['item_category_id'];
        $item->item_size_id     = $validated['item_size_id'];
        $item->item_gender_id   = $validated['item_gender_id'];
        $item->item_name        = $validated['item_name'];
        $item->item_price       = $validated['item_price'];
        $item->item_comment     = $validated['item_comment'] ?? null;
        $item->quantity         = $validated['quantity'] ?? 20;  // デフォルト20
        $item->save();  // 商品を保存

        // 画像のアップロードと保存
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // 画像をストレージに保存
                $path = $imageFile->store('images', 'public');

                // 画像をデータベースに保存
                $image = Image::create(['path' => $path]);

                // 商品と画像を関連付け
                $item->images()->attach($image);
            }
        }

        // 作成後、商品一覧ページへリダイレクト
        return redirect()->route('admin.items.index');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // 商品を削除
        $item->delete();

        return redirect()->route('admin.items.index');
    }
}
