<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class MeController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth']);
	}

    public function __invoke(Request $request)
    {
    	return new UserResource($request->user());
    }
}
