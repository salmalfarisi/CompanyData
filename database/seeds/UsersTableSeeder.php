<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('employees')->truncate();
		DB::table('companies')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		
		$password = Hash::make('password');
		$now = Carbon::now();
		DB::table('users')->insert([
			'name' => 'admin',
			'email' => 'admin@folkatech.com',
			'is_admin' => 1,
			'password' => $password,
			'created_at' => $now,
		]);
    }
}
