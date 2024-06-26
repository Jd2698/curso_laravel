<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{

	//200 (consulta), 201 (crear), 204 (sin cuerpo)
	public function index(Request $request)
	{
		$users = User::with('roles')->get();
		if (!$request->ajax()) return view('users.index', compact('users'));
		return response()->json(['status' => $users], 200);
	}

	public function create()
	{
		$roles = Role::all()->pluck('name');
		return view('users.create', compact('roles'));
	}

	public function store(UserRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		$user->assignRole($request->role);

		if (!$request->ajax()) return back()->with('success', 'User Created');
		return response()->json(['status' => 'User Created', 'user' => $user], 201);
	}

	public function show(Request $request, User $user)
	{
		if (!$request->ajax()) return view('users.index');
		return response()->json(['user' => $user], 200);
	}

	public function edit(User $user)
	{
		$userDatabase = User::with('roles')->find($user->id);
		$user["roles"] = $userDatabase->roles;

		$roles = Role::all()->pluck('name');
		return view('users.edit', compact('user', 'roles'));
	}

	public function update(UserRequest $request, User $user)
	{
		$data = $request->all();
		if ($data['password'] === null) {
			unset($data['password'], $data['password_confirmation']);
		}
		$user->update($data);
		$user->syncRoles([$request->role]);

		if (!$request->ajax()) return back()->with('success', 'User Updated');
		return response()->json([], 204);
	}

	public function destroy(Request $request, User $user)
	{
		$user->delete();
		if (!$request->ajax()) return back()->with('success', 'User Deleted');
		return response()->json([], 204);
	}
}
