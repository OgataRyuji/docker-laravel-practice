<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = ['nickname' => 'aaaaaaaa','email' => 'aa@aa.com','password' => '1234567890','created_at' => now(),];
		$user = new User;
		$user->fill($data)->save();

		$data = ['nickname' => 'bbbbbbbb','email' => 'bb@bb.com','password' => '1234567890','created_at' => now(),];
		$user = new User;
		$user->fill($data)->save();

		$data = ['nickname' => 'cccccccc','email' => 'cc@cc.com','password' => '1234567890','created_at' => now(),];
		$user = new User;
		$user->fill($data)->save();
	}
}
