<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//追加
use Illuminate\Support\Facades\Route;//追加
use Illuminate\Foundation\Testing\RefreshDatabase;//追加
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Testing\Fluent\AssertableJson;//追加
use Tests\TestCase;//追加
use Illuminate\Support\Facades\Artisan;//追加


class AdminLoginTest extends TestCase
{

    use RefreshDatabase;


    /**
     * ログインフォームテスト
     */
    public function testAdminLogin()
    {

        $admin = Admin::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        //リダイレクト処理を確認
        $response->assertRedirect(route('admin.items.index'));

        // 指定したユーザーが認証されていることを確認
        $this->assertAuthenticatedAs($admin, 'admin');
}
}
