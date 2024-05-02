<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Book\BookRequest;
use App\Http\Requests\Book\BookUpdateRequest;

class BookController extends Controller
{
	use UploadFile;
	//200 (consulta), 201 (crear), 204 (sin cuerpo)
	public function home(Request $request)
	{
		$books = Book::with('author', 'category', 'file')->get();
		if (!$request->ajax()) return view('index', compact('books'));
	}

	public function index(Request $request)
	{
		$authors = Author::get();
		$books = Book::with('author', 'category', 'file')->get();
		if (!$request->ajax()) return view('books.index', compact('books', 'authors'));
		return response()->json(['books' => $books], 200);
	}

	public function store(BookRequest $request)
	{

		try {
			DB::beginTransaction();
			$book = new Book($request->all());
			$book->save();
			$this->uploadFile($book, $request);
			DB::commit();
			return response()->json(['status' => 'Book Created', 'book' => $book], 201);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function show(Request $request, Book $book)
	{
		return response()->json(['Book' => $book], 200);
	}

	public function update(BookUpdateRequest $request, Book $book)
	{
		// dd($request->toArray());
		if (!$request->hasFile('file')) unset($request['file']);

		try {
			DB::beginTransaction();
			$book->update($request->all());

			$this->uploadFile($book, $request);
			DB::commit();
			return response()->json([], 204);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function destroy(Request $request, Book $book)
	{
		$book->delete();
		$this->deleteFile($book);
		return response()->json([], 204);
	}
}
