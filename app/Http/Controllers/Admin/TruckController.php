<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Truck;
use App\Crew;

class TruckController extends Controller
{
    //
    public function index()
    {
    	$trucks = Truck::all();
    	return view('admin.truck.index', compact('trucks'));
    }

    public function getMoveInfo($id)
    {
    	$truck = Truck::with('moves')->findOrFail($id);
    	$moves = $truck->moves;
    	foreach($moves as $move) {
    		$crew = Crew::with('movers')->findOrFail($move->crew_id);
    		$move->crew = $crew;
    	}

    	return response()->json($moves);
    }
}
