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
			'title' => ['required', 'string'],
			'stock' => ['required', 'numeric'],
			'description' => ['required', 'string'],
			'category_id' => ['required', Rule::exists(Category::class, 'id')],
			'author_id' => ['required', 'exists:authors,id']
		];

		return $rules;
	}
	public function messages()
	{
		return [
			'title.required' => 'El titulo es requerido.',
			'title.string' => 'El nombre debe de ser valido.',
			'description.required' => 'La descripcion es requerida.',
			'description.string' => 'La descripcion debe de ser valida.',
			'stock.required' => 'La cantidad es requerida.',
			'stock.numeric' => 'La cantidad debe de ser un numero valido.',
			'author_id.required' => 'El autor es requerido.',
			'author_id.exists' => 'El autor no existe.',
			'category_id.required' => 'La categoria es requerida.',
			'category_id.exists' => 'La categoria no existe.',
		];
	}
}
