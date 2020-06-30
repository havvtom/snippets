<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SnippetCollection;

class SnippetController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth:api']);
	}

    public function index(Request $request)
    {
    	return new SnippetCollection($request->user()->snippets);
    }
    
}
