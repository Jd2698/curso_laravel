<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		/** @var \App\Model\User\User $user */
		$user = Auth::user();
		if ($user->hasRole('admin')) return redirect('/users');
		return redirect('');
	}
}
