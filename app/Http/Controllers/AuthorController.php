<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\Author\AuthorRequest;

class AuthorController extends Controller
{

	//200 (consulta), 201 (crear), 204 (sin cuerpo)
	public function index(Request $request)
	{
		$author = Author::get();
		return response()->json(['status' => $author], 200);
	}

	public function create()
	{
		//
	}

	public function store(AuthorRequest $request)
	{
		$author = new Author($request->all());
		$author->save();
		return response()->json(['status' => 'Author Created', 'user' => $author], 201);
	}

	public function show(Request $request, Author $author)
	{
		return response()->json(['author' => $author], 200);
	}

	public function edit($id)
	{
		//
	}

	public function update(AuthorRequest $request, Author $author)
	{
		$author->update($request->all());
		return response()->json([], 204);
	}

	public function destroy(Request $request, Author $author)
	{
		$author->delete();
		return response()->json([], 204);
	}
}
