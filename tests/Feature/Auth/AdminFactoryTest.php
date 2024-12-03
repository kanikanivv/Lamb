<?php

namespace Tests\Feature;

use App\Models\Admin;
use Faker\Factory as Faker;  // Fakerのインポートを修正
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;



class AdminFactoryTest extends TestCase
{
    use RefreshDatabase;  // データベースのリフレッシュを使う場合

public function test_admin_creation()
{
    $faker = Faker::create();
    // Adminファクトリを使って新しいAdminを作成
    $admin = Admin::factory()->create([
        'admin_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_varified_at' => now(),
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
    ]);

    // 追加のアサーションやテスト内容を書く
    $this->assertNotNull($admin);
    $this->assertEquals($admin->admin_name, $faker->name);
}
}
