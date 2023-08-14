<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function rooms()
    {
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }
    public function roomsRegistration()
    {
        return view('roomsRegistration');
    }
    public function roomsRegistrationPost(Request $request)
    { // id	room_name	location	max_capacity	min_capacity	image1	image2	image3	created_at	updated_at
        $room = new Room;
        $room->room_name = $request->room_name;
        $room->location = $request->location;
        $room->max_capacity = $request->max_capacity;
        $room->min_capacity = $request->min_capacity;

        // Handle image uploads and renaming
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $image1Path = $this->uploadAndRenameImage($image1, $room->room_name);
            $room->image1 = $image1Path;
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2Path = $this->uploadAndRenameImage($image2, $room->room_name);
            $room->image2 = $image2Path;
        }

        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $image3Path = $this->uploadAndRenameImage($image3, $room->room_name);
            $room->image3 = $image3Path;
        }

        $room->save();
        return redirect()->route('rooms')->with(['message' => 'Room was registered Successfully!']);
    }

    public function viewRoom($id)
    {
        $room = Room::find($id);
        return view('viewRoom', compact('room'));
    }

    public function roomsEditPost(Request $request)
    {
        $room = Room::where('id', $request->id)->first();
        $room->room_name = $request->room_name;
        $room->location = $request->location;
        $room->max_capacity = $request->max_capacity;
        $room->min_capacity = $request->min_capacity;

        // Handle image uploads and renaming
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $image1Path = $this->uploadAndRenameImage($image1, $room->room_name);
            $room->image1 = $image1Path;
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2Path = $this->uploadAndRenameImage($image2, $room->room_name);
            $room->image2 = $image2Path;
        }

        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $image3Path = $this->uploadAndRenameImage($image3, $room->room_name);
            $room->image3 = $image3Path;
        }

        $room->save();
        return redirect()->route('viewRoom', $request->id)->with(['message' => 'Room was Updated Successfully!']);
    }

    //

    private function uploadAndRenameImage($imageFile, $roomName)
    {
        $extension = $imageFile->getClientOriginalExtension();
        $originalFileName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        $uniqueFileName = $originalFileName . '_' . $roomName . '_' . now()->format('YmdHis') . '.' . $extension;
        $imagePath = 'images/' . $uniqueFileName;

        $imageFile->move(public_path('images'), $uniqueFileName);

        return $imagePath;
    }



}
