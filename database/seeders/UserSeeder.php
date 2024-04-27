<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
	public function run()
	{
		User::create([
			'number_id' => "1004233282",
			'name' => 'Jamer',
			'last_name' => 'Delgado',
			'email' => 'j.delgado2698@gmail.com',
			'password' => '123456789',
			'remember_token' => Str::random(10)
		])->assignRole('admin');
	}
}
