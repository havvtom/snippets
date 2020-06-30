<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Step;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\StepCollection;
use App\Http\Resources\PrimitiveUserResource;
use App\Http\Resources\PublicUserResource;

class Snippet extends Model
{
    use Searchable;

    protected $guarded = [];

    public static function boot()
    {
    	parent::boot();

    	static::created( function (Snippet $snippet) {
    		$snippet->steps()->create([
    			'order' => 1
    		]);
    	});

    	static::creating( function (Snippet $snippet) {
    		$snippet->uuid = Str::uuid();
    	});
    }

    public function toSearchableArray()
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

    public function scopePublic(Builder $builder)
    {
        return $builder->where('is_public', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function steps ()
    {
    	return $this->hasMany(Step::class)->orderBy('order', 'ASC');
    }

    public function getRouteKeyName()
    {
    	return 'uuid';
    }

    public function isPublic()
    {
        return $this->is_public;
    }
}
