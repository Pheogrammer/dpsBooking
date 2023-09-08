<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

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
        $room->price = $request->price;
        $room->outsidePrice = $request->outsidePrice;

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

        $room->price = $request->price;
        $room->outsidePrice = $request->outsidePrice;
        
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

    public function roomsDelete($id)
    {
        try {
            $room = Room::findOrFail($id);

            // Delete images from public directory
            if ($room->image1) {
                File::delete(public_path('' . $room->image1));
            }
            if ($room->image2) {
                File::delete(public_path('' . $room->image2));
            }
            if ($room->image3) {
                File::delete(public_path('' . $room->image3));
            }

            $room->delete();
            return redirect()->route('rooms')->with(['message' => 'Room was Deleted Successfully!']);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('rooms')->with(['error' => 'Room not found']);
        }

    }

    public function bookings()
    {
        $data = Application::where('status', 0)->orderby('status', 'asc')->get();
        return view('bookings', ['data' => $data]);

    }

    public function AcceptedBookings()
    {
        $data = Application::where('status', 1)->orderby('status', 'asc')->get();
        return view('AcceptedBookings', ['data' => $data]);

    }

    public function RejectedBookings()
    {
        $data = Application::where('status', 2)->orderby('status', 'asc')->get();
        return view('RejectedBookings', ['data' => $data]);

    }

    public function viewApplication($id)
    {
        $data = Application::find($id);
        $other = Application::where('roomID', $data->roomID)->where('start_date', $data->start_date)->where('status', '<>', 2)->where('id', '<>', $data->id)->get();
        return view('viewApplication', ['data' => $data, 'other' => $other]);
    }

    public function AcceptApplication($id)
    {
        $data = Application::where('id', $id)->first();
        $data->status = 1;
        $data->save();

        return redirect()->route('bookings')->with(['message' => 'Booking Accepted Successfully']);
    }

    public function RejectApplication($id)
    {
        $data = Application::where('id', $id)->first();
        $data->status = 2;
        $data->save();

        return redirect()->route('bookings')->with(['message' => 'Booking Rejected Successfully']);
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
