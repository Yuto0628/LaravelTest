<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleStoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->assertDatabaseEmpty('articles');
        $response = $this->post('/article', ['author' => 'hoge', 'title' => 'hogehoge', 'body' => 'hoge_body']);

        $response->assertStatus(200);
        $this->assertDatabaseHas('articles', ['author' => 'hoge', 'title' => 'hogehoge', 'body' => 'hoge_body']);
        $this->assertDatabaseCount('articles', 1);
    }

    public function test_準異常系(): void
    {
        $this->assertDatabaseEmpty('articles');
        $response = $this->post('/article', ['title' => 'hogehoge', 'body' => 'hoge_body']);

        $response->assertStatus(400);
        $this->assertDatabaseEmpty('articles');
    }
}
