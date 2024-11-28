<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Category;
use App\Models\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
     * 新規作成画面を表示
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
     * 商品を新規登録
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
            'item_price'        => 'required|numeric|min:0',
            'item_name'         => 'required|string|max:20',
            'item_comment'      => 'nullable|string|max:1000',
            'quantity'        => 'nullable|numeric|min:0',
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

        // 画像の保存処理（画像がアップロードされた場合）
        if ($request->hasFile('images')) {
            // 既存の画像があれば削除（複数画像の場合、関連テーブルの画像を削除）
            $item->images()->each(function ($image) {
                // 画像をストレージから削除
                if (file_exists(storage_path('app/public/' . $image->path))) {
                    unlink(storage_path('app/public/' . $image->path));
                }
                // データベースから削除
                $image->delete();
            });

            // 新しい画像を保存
            $imagePaths = [];
            foreach ($request->file('images') as $imageFile) {
                // 各画像を保存
                $path = $imageFile->store('images', 'public');  // public/images フォルダに保存
                $imagePaths[] = basename($path);  // 保存した画像のファイル名を配列に追加
            }

            // 画像のパスをデータベースに保存
            // ここでは画像を中間テーブルに保存（例: Imageモデルとの関連付け）
            $item->images()->createMany(array_map(function ($path) use ($item) {
                return [
                    'path' => 'images/' . $path,
                    'item_id' => $item->id,
                ];
            }, $imagePaths));
        }

        // 作成後、商品一覧ページへリダイレクト
        return redirect()->route('admin.items.index')->with('success', 'アイテムが登録されました');
    }

    /**
     * 商品の編集画面を表示
     *
     * @return View
     */
    public function edit($id): View
    {
        $item       = Item::find($id);
        $categories = Category::orderBy('id')->get();
        $sizes      = Size::orderBy('id')->get();
        $genders    = Gender::orderBy('id')->get();
        $images     = $item->images;

        return view('admin.items.edit', compact('item', 'categories', 'sizes', 'genders', 'images'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        // アイテムの取得
        $item = Item::find($id);
        if (!$item) {
            return redirect()->route('admin.items.index')->with('error', 'アイテムが見つかりません');
        }

        // 価格のカンマを削除
        $request->merge([
            'item_price' => preg_replace('/,/', '', $request->item_price),  // 価格からカンマを削除
        ]);

        // バリデーション
        $validated = $request->validate([
            'item_category_id'  => 'required|integer|exists:categories,id',
            'item_size_id'      => 'required|integer|exists:sizes,id',
            'item_gender_id'    => 'required|integer|exists:genders,id',
            'item_price'        => 'required|numeric|min:0',
            'item_name'         => 'required|string|max:20',
            'item_comment'      => 'nullable|string|max:1000',
            'quantity'          => 'nullable|numeric|min:0',
            'images'            => 'array|max:4',
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 商品の更新
        $item->item_category_id = $validated['item_category_id'];
        $item->item_size_id     = $validated['item_size_id'];
        $item->item_gender_id   = $validated['item_gender_id'];
        $item->item_name        = $validated['item_name'];
        $item->item_price       = $validated['item_price'];
        $item->item_comment     = $validated['item_comment'] ?? null;
        $item->quantity         = $validated['quantity'] ?? 20;  // デフォルト20
        $item->save();  // 商品を保存

        // 画像の保存処理（画像がアップロードされた場合）
        if ($request->hasFile('images')) {
            // 既存の画像があれば削除（複数画像の場合、関連テーブルの画像を削除）
            $item->images()->each(function ($image) {
                // 画像をストレージから削除
                if (file_exists(storage_path('app/public/' . $image->path))) {
                    unlink(storage_path('app/public/' . $image->path));
                }
                // データベースから削除
                $image->delete();
            });

            // 新しい画像を保存
            $imagePaths = [];
            foreach ($request->file('images') as $imageFile) {
                // 各画像を保存
                $path = $imageFile->store('images', 'public');  // public/images フォルダに保存
                $imagePaths[] = basename($path);  // 保存した画像のファイル名を配列に追加
            }

            // 画像のパスをデータベースに保存
            // ここでは画像を中間テーブルに保存（例: Imageモデルとの関連付け）
            $item->images()->createMany(array_map(function ($path) use ($item) {
                return [
                    'path' => 'images/' . $path,
                    'item_id' => $item->id,
                ];
            }, $imagePaths));
        }

        // アイテム更新後のリダイレクト
        return redirect()->route('admin.items.edit', $item->id)->with('success', 'アイテムが更新されました');
    }
}
