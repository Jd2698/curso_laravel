<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\File;
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

	public function configure()
	{
		return $this->afterCreating(function (Book $book) {
			$file = new File(['route' => '/storage/images/books/default.png']);
			$book->file()->save($file);
		});
	}
}
