<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Gender;
use App\Models\Category;
use App\Models\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
     * @return void
     */
    public function store(Request $request): RedirectResponse
    {

        $image = new Image;
        $image->name = $request->name;
        $path = $request->file('image')->store('public/image');
        $filename = basename($path);
        $item->image = $filename;
        $item->save();

        $item = new Item();
        $item->item_name = $request->input('item_name');
        $item->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('images', 'public');

                $image = Image::create(['path' => $path]);

                $item->images()->attach($image);
            }
        }

        // バリデーション
        $validated = $request->validate([
            'item_category_id'  => 'required|integer|exists:item_categories,id',
            'item_size_id'      => 'required|integer|exists:item_sizes,id',
            'item_gender_id'    => 'required|integer|exists:item_genders,id',
            'item_name'         => 'required|string|max:60',
            'item_price'        => 'required|numeric|min:0',
            'item_comment'      => 'nullable|string|max:1000',
            'item_count'        => 'nullable|numeric|min:0',
            'images'            => 'array|max:4',
            'images.*'          => 'image|mimes:jpeg,png,jpg,git,svg|max:2048',
        ]);

        // バリデーションが成功した場合、データベースに保存
        DB::table('items')->insert([
            'id'                => $validated['id'],
            'item_category_id'  => $validated['item_category_id'],
            'item_size_id'      => $validated['item_size_id'],
            'item_gender_id'    => $validated['item_gender_id'],
            'item_name'         => $validated['item_name'],
            'item_price'        => $validated['item_price'],
            'item_comment'      => $validated['item_comment'] ?? null,
            'item_count'        => 20,  // 固定値20
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return to_route('admin.items.index');
    }
}
