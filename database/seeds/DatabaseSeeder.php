<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->checkForeignKeys(false);

		$this->truncateTables(array(
			'users',
			'password_resets',
			'tickets',
			'ticket_votes',
			'ticket_comments',
		));

		$this->checkForeignKeys(true);

		$this->call('UserTableSeeder');
		$this->call('TicketTableSeeder');
		$this->call('TicketCommentTableSeeder');
		$this->call('TicketVoteTableSeeder');
	}

	private function truncateTables(array $tables)
	{
		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}
	}

	private function checkForeignKeys($check)
	{
		$check = $check ? '1' : '0';

		DB::statement("SET FOREIGN_KEY_CHECKS = $check");
	}

}
