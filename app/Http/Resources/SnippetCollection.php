<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\SnippetResource;

class SnippetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = SnippetResource::class;
    
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
