<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class TestBatch extends Command
{
	/**
	 * The name and signature of the console command.
	 * artisanコマンドで呼び出す時のコマンド名を定義する
	 * @var string
	 */
	protected $signature = 'batch:test';

	/**
	 * The console command description.
	 * artisanコマンド一覧の出力時に表示される説明文、必須ではないが設定推奨
	 * @var string
	 */
	protected $description = 'お試しのバッチ処理';

	/**
	 * Create a new command instance.
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *  実際の処理をこのメソッド内に記述する
	 * @return int
	 */
	public function handle()
	{
		//echo User::all();
		for ($i=0; $i < 4; $i++) { 
			logger()->info("Hello!");
		}
		return 0;
	}
}
