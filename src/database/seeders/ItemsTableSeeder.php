<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = ['item_title' => 'サンプルタイトルa','item_explain' => 'サンプル記事a','created_at' => now(),'user_id' => '1'];
			$item = new Item;
			$item->fill($data)->save();

			$data = ['item_title' => 'サンプルタイトルb','item_explain' => 'サンプル記事b','created_at' => now(),'user_id' => '2'];
			$item = new Item;
			$item->fill($data)->save();

			$data = ['item_title' => 'サンプルタイトルc','item_explain' => 'サンプル記事c','created_at' => now(),'user_id' => '3'];
			$item = new Item;
			$item->fill($data)->save();
    }
}
