<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;  // テスト後にデータベースをリフレッシュする

    // setUpメソッドはテストクラスの一部として定義します
    protected function setUp(): void
    {
        parent::setUp();
        // ここにセットアップの処理を書く
        dump('setUp');
    }

    // 通常のテストメソッドを定義します
    public function test_example()
    {
        $response = $this->get('/');  // 例：トップページにGETリクエスト
        $response->assertStatus(200);  // レスポンスが200であることを確認
    }
}
