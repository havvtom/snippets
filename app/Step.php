<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Snippet;

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

    public function snippet()
    {
    	return $this->belongsTo(Snippet::class);
    }

    public function getRouteKeyName ()
    {
    	return 'uuid';
    }

    public function afterOrder ()
    {
    	$adjacent = self::where('order', '>', $this->order)->orderBy('order', 'asc')->first();

    	if(!$adjacent){
    		return self::orderBy('order', 'desc')->first()->order + 1;
    	}

    	return ($adjacent->order + $this->order) / 2 ;
    }

    public function beforeOrder ()
    {
    	$adjacent = self::where('order', '<', $this->order)->orderBy('order', 'desc')->first();

    	if(!$adjacent){
    		return self::orderBy('order', 'asc')->first()->order - 1;
    	}

    	return ($adjacent->order + $this->order) / 2 ;
    }
}
