<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
	public function run()
	{
		Role::create(['name' => 'user']);
		Role::create(['name' => 'admin']);
	}
}
