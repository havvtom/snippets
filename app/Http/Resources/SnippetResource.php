<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StepCollection;
use App\Http\Resources\PublicUserResource;

class SnippetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title ?: '',
            'is_public' => (bool) $this->is_public,
            'steps_count' => $this->steps->count(),
            'steps' => new StepCollection($this->steps),
            'author' => new PublicUserResource($this->user),
            'user' => new PrimitiveUserResource($this)
        ];
    }
}
