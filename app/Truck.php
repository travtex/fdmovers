<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    //
    protected $dates = ['serviced_at'];
    protected $fillable = ['make_model', 'model_year', 'vin'];

    public function moves() 
    {
    	return $this->hasMany('App\Move');
    }
}
