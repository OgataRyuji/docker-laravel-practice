<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
/*
    public function testBasicTest()
    {
      $this->get('/')->assertStatus(200);
      $this->get('/registration_pre')->assertStatus(200);
      $this->get('/registration_pre_success')->assertStatus(200);
      $this->withoutExceptionHandling();
      $this->get('/registration_main')->assertOk();
              $user = User::create([
                'nickname' => 'テストニックネーム',
                'email' => 'test@email.com',
                'password' => 'aaaaaaaaaa',
              ]);
      $this->get('/registration_main_success')->assertStatus(200);
      $this->get('/session')->assertStatus(200);
      $this->get('/index')->assertStatus(200);
      $this->get('/item_new')->assertStatus(200);
      $this->get('/detail?user_id=1&item_id=1&post_user=1')->assertStatus(200);
      $this->get('/edit_item')->assertStatus(500);
      $this->get('/delete')->assertStatus(500);
      $this->withCookie('user_id', 1)->get('/mypage')->assertStatus(200);
      $this->get('/edit_user')->assertStatus(200);
      $this->get('/edit_comment')->assertStatus(200);
      $this->get('/delete_comment')->assertStatus(200);
      $this->get('/logout')->assertStatus(200);
      $this->get('/hoge')->assertStatus(404);
      $this->get('/index')->assertSeeText('サイトタイトル');
      $this->get('/index')->assertSee('<input>');
    //}
*/
}
