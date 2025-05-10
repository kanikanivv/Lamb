<?php
namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{

    public function test_正しくログインできた場合()
    {
        $admin = Admin::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $this->assertGuest();  //未ログイン状態であることをチェック

        $response = $this->actingAs($admin, 'admin')->get('admin/items/index', [
            'email' => $admin->email,  // ログインフォームで送信されるデータを模倣
            'password' => 'password',  // 正しいパスワード
        ]);
        $response->assertStatus(200);
    }

    public function test__正しくできない場合()
    {

        $admin = Admin::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $this->assertGuest();  //未ログイン状態であることをチェック

        $response = $this->post('admin/login', [
            'email' => $admin->email,  // ログインフォームで送信されるデータを模倣
            'password' => 'wordpassword',  // 誤ったパスワード
        ]);
        $response->assertSessionHasErrors(['login' => 'ログイン情報が正しくありません。']);
        //ログインユーザのまま
        $this->assertGuest();
    }

    public function test_ログアウト()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');
        $this->assertAuthenticated();
        $response = $this->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
