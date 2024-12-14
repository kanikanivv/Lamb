<?php
namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Item;
use App\Models\Size;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryTest extends TestCase
{
    public function test__性別画面表示()
    {
        //カテゴリー管理から性別一覧に遷移
        $response = $this->from(route('admin.categories.index'))
        ->get(route('admin.categories.genders.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.genders.index');

        //性別一覧にgender表示
        $response->assertViewHas('genders');
    }

    public function test__サイズ一覧画面表示()
    {
        $response = $this->from(route('admin.categories.index'))
        ->get(route('admin.categories.sizes.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.sizes.index');

        //サイズ一覧にsize表示
        $response->assertViewHas('sizes');
    }

    public function test__アイテム一覧画面表示()
    {
        $response = $this->from(route('admin.categories.index'))->get(route('admin.categories.itemscategory.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.itemscategory.index');
        //アイテム一覧にcategories表示
        $response->assertViewHas('itemcategories');
    }

    public function test__新規登録ボタンの遷移()
    {
        $response = $this->from(route('admin.categories.itemscategory.index'))
        ->get(route('admin.categories.itemscategory.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.itemscategory.create');
    }

    // public function test__新規登録処理()
    // {
    //     $category = Category::factory()->create();

    //     $response = $this->post(route('admin.categories.itemscategory.store', [
    //         'category_name' => 'バッグ'
    //     ]));

    //     $response->assertRedirect(route('admin.categories.itemscategory.index'));

    //     $this->assertDatabaseHas('categories', [
    //         'category_name' => 'バッグ'
    //     ]);
    // }

    public function test__更新画面遷移()
    {
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.itemscategory.edit', $category->id));

        $response->assertStatus(200);
        $response->assertViewHas('itemcategory');
    }

    public function test__更新処理()
    {

        $itemcategory = Category::factory()->create();
        $updatebase = [
            'category_name' => 'www',
        ];

        $response = $this->put(route('admin.categories.itemscategory.update', $itemcategory->id), $updatebase);

        $response->assertRedirect(route('admin.categories.itemscategory.index', ['itemcategory' => $itemcategory->id]));
        $response->assertSessionHas('create', 'アイテム情報が更新されました');

        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', [
            'category_name' => 'www'
        ]);
    }
}
