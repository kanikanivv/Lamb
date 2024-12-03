<?php
namespace Tests\Feature;//追加

use Tests\TestCase;//追加
use App\Models\User;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;//追加
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;//追加

class CartControllerTest extends TestCase//追加
{
    use RefreshDatabase; //追加

    /**
     * カートページの表示テスト
     *
     * @return void
     */
    public function test_index()
    {
        // テスト用ユーザーを作成
        $user = User::factory()->create();

        // テスト用アイテムを作成
        $item = Item::factory()->create();

        // ユーザーがカートにアイテムを追加
        Cart::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'quantity' => 2,
        ]);

        // ログインする
        $this->actingAs($user);

        // カートページへのGETリクエストを送信
        $response = $this->get(route('carts.index'));

        // レスポンスが正常であることを確認
        $response->assertStatus(200);

        // カートにアイテムが表示されているか確認
        $response->assertViewHas('carts');
    }

    /**
     * カートに商品を追加するテスト
     *
     * @return void
     */
    public function test_store()
    {
        // テスト用ユーザーを作成
        $user = User::factory()->create();

        // テスト用アイテムを作成
        $item = Item::factory()->create();

        // ログインする
        $this->actingAs($user);

        // 商品をカートに追加するリクエストデータ
        $data = [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'quantity' => 2,
            'action' => 'cart', // ボタンのvalue
        ];

        // POSTリクエストを送信してカートに商品を追加
        $response = $this->post(route('carts.store'), $data);

        // カートに商品が追加されたことを確認
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'quantity' => 2,
        ]);

        // 商品ページへリダイレクトされることを確認
        $response->assertRedirect(route('items.show'));
    }

    /**
     * 同じ商品がカートに既にある場合、数量が更新されることを確認
     *
     * @return void
     */
    public function test_store_update_quantity_if_exists()
    {
        // テスト用ユーザーを作成
        $user = User::factory()->create();

        // テスト用アイテムを作成
        $item = Item::factory()->create();

        // カートに既に商品が入っている状態
        Cart::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'quantity' => 1,
        ]);

        // ログインする
        $this->actingAs($user);

        // 商品をカートに追加するリクエストデータ（同じ商品を追加）
        $data = [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'quantity' => 3, // 数量は3に更新
            'action' => 'cart',
        ];

        // POSTリクエストを送信
        $response = $this->post(route('carts.store'), $data);

        // カート内の商品が更新されたことを確認
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'quantity' => 4, // 既存の1と新たに追加された3が合計で4になる
        ]);

        // 商品ページへリダイレクトされることを確認
        $response->assertRedirect(route('items.show'));
    }
}
