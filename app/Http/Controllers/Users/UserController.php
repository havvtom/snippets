<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\PublicUserResource;

class UserController extends Controller
{
    public function show(User $user)
    {
    	return new PublicUserResource($user);
    }

    public function update(User $user, Request $request)
    {
    	//authorize
    	$this->authorize('as', $user);

		$request->validate([
			'email' => 'required|email|unique:users,email,'.$request->user()->id,
			'username' => 'required|alpha_dash|unique:users,username,'.$request->user()->id,
			'name' => 'required',
			'password' => 'nullable|min:6'
		]);

		$user->update(
			$request->only('email', 'username', 'name', 'password')
		);
    }
}
