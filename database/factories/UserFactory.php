<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
	public function definition()
	{
		return [
			'number_id' => $this->faker->randomNumber(9, true),
			'name' => $this->faker->name(),
			'last_name' => $this->faker->name(),
			'email' => $this->faker->unique()->safeEmail(),
			'password' => '123456789',
			'remember_token' => Str::random(10),
		];
	}

	public function configure()
	{
		return $this->afterCreating(function (User $user) {
			$user->assignRole('user');
		});
	}
}
