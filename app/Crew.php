<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    //
    protected $fillable = ['name'];

    public function movers()
    {
    	return $this->belongsToMany('App\Mover');
    }

    public function moves() 
    {
    	return $this->hasMany('App\Move');
    }

}
