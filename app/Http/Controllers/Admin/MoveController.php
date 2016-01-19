<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Move;

class MoveController extends Controller
{
    //
    public function index()
    {
    	$moves = Move::all();
    	return view('admin.move.index', compact('moves'));
    }
}