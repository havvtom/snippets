<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SnippetCollection;
use App\User;

class SnippetController extends Controller
{
    public function index(User $user)
    {
    	return new SnippetCollection(
    		$user->snippets()->public()->get()
    	);
    }
}
