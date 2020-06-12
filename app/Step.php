<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Step extends Model
{
    protected $guarded = [];

    public static function boot()
    {
    	parent::boot();

    	static::creating( function (Step $step) {
    		$step->uuid = Str::uuid();
    	});
    }
}
