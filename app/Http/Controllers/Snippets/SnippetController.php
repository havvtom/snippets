<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Snippet;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\SnippetCollection;

class SnippetController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth:api'])->except('show');
	} 

	public function index (Request $request)
	{
		return new SnippetCollection(Snippet::take($request->get('limit', 10))->latest()->public()->get());
	}

	public function show(Snippet $snippet)
	{
		$this->authorize('show', $snippet);

		return new SnippetResource($snippet);
	}

    public function store(Request $request)
    {
    	$snippet = $request->user()->snippets()->create();

    	return new SnippetResource($snippet);
    }

    public function update(Request $request, Snippet $snippet)
    {
    	$this->authorize('update', $snippet);

    	$request->validate([
    		'title' => 'nullable',
    		'is_public' => 'nullable|boolean'
    	]);
    	
    	$snippet->update($request->only('title', 'is_public'));

    	return new SnippetResource($snippet);
    }

    public function destroy(Snippet $snippet)
    {
        $this->authorize('update', $snippet);
        
        $snippet->delete();
    }
}
