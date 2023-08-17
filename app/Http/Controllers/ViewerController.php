<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

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
    public function bookVenue($id)
    {
        $room = Room::find($id);
        return view('bookVenue', compact('room'));
    }

    public function bookVenuePost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'purpose' => 'required',
            'entity' => 'required',
            'participants' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'attachment' => 'nullable|mimes:jpeg,png,pdf|max:2048',
            // Added valid MIME types
            'paymentMethod' => 'required|in:yes,no',
        ]);

        $existingApplication = Application::where('roomID', $request->id)
            ->where('start_date', '<=', $request->end_date)
            ->where('email', $request->email)
            ->where('end_date', '>=', $request->start_date)
            ->where(function ($query) use ($request) {
                $query->where('email', $request->email)
                    ->where('start_date', $request->start_date)
                    ->orWhere('end_date', $request->end_date);
            })
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'Dear ' . $request->name . ', looks like you have already applied for this venue.');
        }



        $application = new Application();
        $application->roomID = $request->id;
        $application->name = $request->name;
        $application->email = $request->email;
        $application->phone = $request->phone;
        $application->from = $request->address;
        $application->purpose = $request->purpose;
        $application->entity = $request->entity;
        $application->number_of_participants = $request->participants;
        $application->start_date = $request->start_date;
        $application->end_date = $request->end_date;
        $application->conference_services = $request->paymentMethod;

        // Handle attachment upload and rename
        if ($request->hasFile('attachment')) {
            $attachmentPath = $this->uploadAndRenameImage($request->file('attachment'), $request->name);
            $application->attachment = $attachmentPath; // Set the attachment path in the application
        }

        $application->save();

        return redirect()->route('index')->with('message', 'Application submitted successfully');
    }

    private function uploadAndRenameImage($imageFile, $roomName)
    {
        $extension = $imageFile->getClientOriginalExtension();
        $originalFileName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        $uniqueFileName = $originalFileName . '_' . $roomName . '_' . now()->format('YmdHis') . '.' . $extension;
        $imagePath = 'ApplicationAttachments/' . $uniqueFileName;

        $imageFile->move(public_path('ApplicationAttachments'), $uniqueFileName); // Upload to public path

        return $imagePath;
    }

}
