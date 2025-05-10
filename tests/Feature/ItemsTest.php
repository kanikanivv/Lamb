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


class AdminItemsTest extends TestCase
{

    public function test__新規作成のボタン遷移()
    {
        $category = Category::factory()->create();
        $gender = Gender::factory()->create();
        $size = Size::factory()->create();

        //create画面遷移
        $response = $this->get(route('admin.items.create'));

        //正常に表示されるか
        $response->assertStatus(200);
        $response->assertViewIs('admin.items.create');
        $response->assertViewHas('categories');
        $response->assertViewHas('sizes');
        $response->assertViewHas('genders');
    }

    public function test__ログインしてないユーザはログイン画面に遷移()
    {
        $this->assertGuest();

        $response = $this->get(route('admin.login'));
    }

    public function test__新規作成処理()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $gender = Gender::factory()->create();
        $size = Size::factory()->create();

        //新規作成処理
        $response = $this->post(route('admin.items.store', [
            'item_category_id' => $category->id,
            'item_size_id' => $size->id,
            'item_gender_id' => $gender->id,
            'item_name' => 'test',
            'item_price' => 2000,
            'item_comment' => 'Test comment',
            'quantity' => 10
        ]));

        //リダイレクト処理
        $response->assertRedirect(route('admin.items.index'));

        $this->assertDatabaseHas('items', [
            'item_category_id' => $category->id,
            'item_size_id' => $size->id,
            'item_gender_id' => $gender->id,
            'item_name' => 'test',
            'item_price' => 2000,
            'item_comment' => 'Test comment',
            'quantity' => 10
        ]);
    }

    public function test__更新画面遷移()
    {

        $image = Image::factory()->create();
        $category = Category::factory()->create();
        $gender = Gender::factory()->create();
        $size = Size::factory()->create();
        $item = Item::factory()->create([
            'item_category_id' => $category->id,
            'item_size_id' => $size->id,
            'item_gender_id' => $gender->id,
        ]);
        $response = $this->get(route('admin.items.edit', $item->id));

        //正常に表示されるか
        $response->assertStatus(200);
        $response->assertViewIs('admin.items.edit');
        $response->assertViewHas('categories');
        $response->assertViewHas('sizes');
        $response->assertViewHas('genders');
        $response->assertViewHas('images');
        $response->assertViewHas('item');
    }

    public function test__戻るボタン()
    {
        $response = $this->get(route('admin.items.index'));
        $response->assertStatus(200);
    }

    public function test__更新処理()
    {
        $imagePath = base_path('tests/storage/test-image.jpg');  // テスト用画像パス
        file_put_contents($imagePath, file_get_contents('https://via.placeholder.com/300x200.jpg'));  // プレースホルダー画像を作成
        $category = Category::factory()->create();
        $gender = Gender::factory()->create();
        $size = Size::factory()->create();
        $item = Item::factory()->create([
            'item_category_id' => $category->id,
            'item_size_id' => $size->id,
            'item_gender_id' => $gender->id,
        ]);


        $updatebase = [
            'item_category_id' => $category->id,
            'item_size_id' => $size->id,
            'item_gender_id' => $gender->id,
            'images' => [$imagePath],
            'item_name' => 'test',
            'item_price' => 2000,
            'item_comment' => 'Test comment',
            'quantity' => 10
        ];

        $response = $this->put(route('admin.items.update', $item->id), $updatebase);

        $response->assertRedirect(route('admin.items.edit', ['id' => $item->id]));
        $response->assertSessionHas('success', 'アイテムが更新されました');

        $this->assertDatabaseHas('items', [
            'item_category_id' => $category->id,
            'item_size_id' => $size->id,
            'item_gender_id' => $gender->id,
            'item_name' => 'test',
            'item_price' => 2000,
            'item_comment' => 'Test comment',
            'quantity' => 10
        ]);

        $this->assertDatabaseHas('image_item', [
            'item_id' => $item->id,
            'image_id' => $image->id
        ]);
        unlink($imagePath);
    }
}
