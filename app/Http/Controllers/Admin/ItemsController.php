<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Gender;
use App\Models\Category;
use App\Models\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    /**
     * 商品の新規作成画面を表示
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        $sizes      = Size::all();
        $genders    = Gender::all();

        return view('admin.items.create', compact('categories', 'sizes', 'genders'));
    }

    /**
     * 商品の新規作成画面で商品を保存
     *
     * @return void
     */
    public function store(Request $request): RedirectResponse
    {
        // バリデーション
        $validated = $request->validate([
            'item_category_id'  => 'required|integer|exists:item_categories,id',
            'item_size_id'      => 'required|integer|exists:item_sizes,id',
            'item_gender_id'    => 'required|integer|exists:item_genders,id',
            'item_name'         => 'required|string|max:60',
            'item_price'        => 'required|numeric|min:0',
            'item_comment'      => 'nullable|string|max:1000',
            'item_count'        => 'nullable|numeric|min:0',
        ]);

        $createdAt = Item::all('created_at')->orderBy('')

        // バリデーションが成功した場合、データベースに保存
        DB::table('items')->insert([
            'id'                => $validated['id'],
            'item_category_id'  => $validated['item_category_id'],
            'item_size_id'      => $validated['item_size_id'],
            'item_gender_id'    => $validated['item_gender_id'],
            'item_name'         => $validated['item_name'],
            'item_price'        => $validated['item_price'],
            'item_comment'      => $validated['item_comment'] ?? null,
            'item_count'        => 20,  // 値20
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return to_route('admin.items.index', ['post' => $post->id]);
    }
}
