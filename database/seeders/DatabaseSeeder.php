<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->call([
			RoleSeeder::class,
			UserSeeder::class,
			CategorySeeder::class
		]);

		User::factory(10)->create();
		Author::factory(3)->create();
	}
}
