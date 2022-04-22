<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use GuzzleHttp\Psr7\Header;
use Illuminate\Support\Facades\Auth;
use Psy\Command\EditCommand;

class UserTest extends TestCase
{
  public function test_addUser()
  {
    $user = User::create([
      'nickname' => 'テストニックネーム',
      'email' => 'test@email.com',
      'password' => 'aaaaaaaaaa',
      'created_at'=>now()
    ]);
    $response = $this->actingAs($user)->get('/registration_main_success');
    $response->assertStatus(200);
  }

  public function test_getlogin()
	{
    $response = $this->get('/session');
    $response->assertStatus(200);
	}

  public function test_postlogin()
	{
    $response = $this->post('/session', [
      'email'    => 'test@email.com',
      'password' => 'aaaaaaaaaa'
      //先ほど設定したパスワードを入力
    ]);

    $response->assertRedirect('/index');
  }

  public function test_getedit()
	{
    $data = [
      'nickname' => "ニックネームヘンコウ",
      'password' => "aaaaaaaaaa"
    ];
    $response = $this->put(route('users.edit_user', ['id' => 2]),$data);
    $response->assertStatus(200);
	}
}