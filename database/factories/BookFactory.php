<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

	public function authorId($author)
	{
		return $this->state([
			'author_id' => $author->id
		]);
	}

	public function definition()
	{
		return [
			'category_id' => $this->faker->randomElement([1, 2, 3]),
			'title' => $this->faker->name(),
			'stock' => $this->faker->randomDigit(),
			'description' => $this->faker->paragraph()
		];
	}
}
