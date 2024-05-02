<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\Book\BookRequest;

class BookUpdateRequest extends BookRequest
{

	public function rules()
	{
		// $this->rules['file'] = ['nullable', 'image'];
		$this->rules['file'] = ['nullable'];
		return $this->rules;
	}
}
