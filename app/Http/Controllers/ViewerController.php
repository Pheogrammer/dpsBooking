<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Room;

class ViewerController extends Controller
{
    //
    public function index()
    {
        $rooms = Room::all();
        return view('welcome', compact('rooms'));
    }
    public function viewDetails($id)
    {
        $room = Room::find($id);
        return view('viewDetails', compact('room'));
    }
}
