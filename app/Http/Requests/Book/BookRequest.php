<?php

namespace App\Http\Requests\Book;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$rules = [
			'category_id' => ['required', 'numeric', Rule::exists(Category::class, 'id')],
			'author_id' => ['required', 'numeric', Rule::exists(Author::class, 'id')],
			'title' => ['required', 'string'],
			'stock' => ['required', 'numeric'],
			'description' => ['required', 'string']
		];

		return $rules;
	}
}
