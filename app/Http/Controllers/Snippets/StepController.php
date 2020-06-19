<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Snippet;
use App\Step;
use App\Http\Resources\StepResource;

class StepController extends Controller
{
    public function update(Snippet $snippet, Step $step, Request $request)
    {
    	//authorize
    	$this->authorize('update', $step);

    	$step->update($request->only('title', 'body'));
    }

    public function store(Snippet $snippet, Request $request)
    {
    	//authorize
    	$this->authorize('storeStep', $snippet);
    	
    	$step = $snippet->steps()->create(array_merge($request->only('title', 'body'), [
    		'order' => $this->getOrder($request)
    	]));

    	return new StepResource($step);
    }

    public function destroy(Snippet $snippet, Step $step)
    {
    	//authorize
    	$this->authorize('destroy', $step);

    	if ($snippet->steps->count() == 1){
    		return response(null, 400);
    	}
    	$step->delete();
    }

    protected function getOrder(Request $request)
    {
    	return Step::where('uuid', $request->before)
    			->orWhere('uuid', $request->after)
    			->first()
    			->{($request->before ? 'before' : 'after') . 'Order'}();
    }
}
