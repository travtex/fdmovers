<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    //
    protected $dates = ['completed_at'];
    protected $fillable = ['truck_id', 'crew_id', 'location'];
    public function crew()
    {
    	return $this->belongsTo('App\Crew');
    }

    public function truck()
    {
    	return $this->belongsTo('App\Truck');
    }
}
