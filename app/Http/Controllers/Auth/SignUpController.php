<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\User;

class SignUpController extends Controller
{
    public function __invoke(Request $request)
    {
    	$request->validate([
			'email' => 'required|email|unique:users,email,',
			'username' => 'required|alpha_dash|unique:users,username,',
			'name' => 'required',
			'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'required'
		]);

		$user = User::create($request->only('name', 'username', 'password', 'email'));

		return new UserResource($user);
    }
}
