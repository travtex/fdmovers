<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mover;
use Illuminate\Support\Facades\Input;
use Validator;

class MoverController extends Controller
{
    //
    public function index()
    {
    	$movers = Mover::all();
    	return view('admin.mover.index', compact('movers'));
    }

    public function addMover(Request $request)
    {
    	$this->validate($request, [
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'email' => 'required|email|unique:movers',
    		'hired_at' => 'required|date'
		]);

        $data = Input::all();
        $data['hired_at'] = strtotime($data['hired_at']);
        $mover = Mover::create($data);

    	return response()->json($mover);
    }
}
