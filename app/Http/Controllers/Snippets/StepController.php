<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Snippet;
use App\Step;

class StepController extends Controller
{
    public function update(Snippet $snippet, Step $step, Request $request)
    {
    	//authorize

    	$step->update($request->only('title', 'body'));
    }
}
