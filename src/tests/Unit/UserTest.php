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
    /*$user = User::create([
      'nickname' => 'テストニックネーム',
      'email' => 'test@email.com',
      'password' => bcrypt('bbbbbbbbbbb'),
    ]);*/

    //$this->assertFalse(Auth::check());

    $response = $this->post('/session', [
      'email'    => 'nobodyknows2405@gmail.com',
      'password' => 'xxxxxxxxxx'
      //先ほど設定したパスワードを入力
    ]);

    $response->assertRedirect('/index');
  }

  public function test_getedit()
	{
    $user = User::where('id', 56)->first(1);
    $cookie = ['user_id'=>'56'];
    $response = $this->actingAs($user)->withCookies($cookie)->call('get','/edit_user',[],$cookie);
    $response->assertCookie($cookie);
    $response->assertStatus(200);
	}
}