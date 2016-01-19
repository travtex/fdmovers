<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mover extends Model
{
    //
    protected $dates = ['hired_at'];
    protected $fillable = ['first_name', 'last_name', 'email', 'hired_at'];

    public function crews()
    {
    	return $this->belongsToMany('App\Crew');
    }

    public function getFullNameAttribute()
    {
    	return ucfirst($this->last_name) . ', ' . ucfirst($this->first_name);
    }

}
