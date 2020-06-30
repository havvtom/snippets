<?php

namespace App\Http\Controllers\Keys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Algolia\AlgoliaSearch\SearchClient;

class AlgoliaKeyController extends Controller
{
    public function __invoke(Request $request)
    {
    	return response()->json([
    		'data' => SearchClient::generateSecuredApiKey(
    			config('scout.algolia.key'), [
    				'filters' => 'is_public:true'
    			]
    		)
    	]);
    }
}
