<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
	//200 (consulta), 201 (crear), 204 (sin cuerpo)
	public function index(Request $request)
	{
		$books = Book::get();
		if (!$request->ajax()) return view('index', compact('books'));
		return response()->json(['books' => $books], 200);
	}

	public function create()
	{
		//
	}

	public function store(BookRequest $request)
	{
		$book = new Book($request->all());
		$book->save();
		return response()->json(['status' => 'Book Created', 'book' => $book], 201);
	}

	public function show(Request $request, Book $book)
	{
		return response()->json(['Book' => $book], 200);
	}

	public function edit($id)
	{
		//
	}

	public function update(BookRequest $request, Book $book)
	{
		$book->update($request->all());
		return response()->json([], 204);
	}

	public function destroy(Request $request, Book $book)
	{
		$book->delete();
		return response()->json([], 204);
	}
}
