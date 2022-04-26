<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\TestBatch;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan command provided by your application.
	 * ここにartisanコマンドクラスを記述する
	 *
	 * @return array
	 */
	protected $commands = [
		TestBatch::class,
	];

	/**
	 * Define the application's command schedule.
	 * artisanコマンドの実行スケジュールを記述する
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	/*
	protected function schedule(Schedule $schedule)
	{
			// $schedule->command('inspire')->hourly();
			//クロージャに直接処理を書くことも可能
			//$schedule->call(function(){
				//echo 'hello!\n';
			//});

			//batch::testを毎時実行し、出力先を$filePathに指定する
			$filePath = '/src/storage/logs/laravel.log';
			$schedule->command('batch:test')->sendOutputTo($filePath)->everyMinute();
	}*/
	protected function schedule(Schedule $schedule)
	{
		$filePath = '/src/storage/logs/laravel.log';
		$schedule->command('batch:test')->sendOutputTo($filePath)->everyTwoMinutes();
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
			$this->load(__DIR__.'/Commands');

			require base_path('routes/console.php');
	}
}
