<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Register;
use App\Models\Banner;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.index');
    }



    public function home()
    {
        $events = Event::all();

        return view('home.index', ['events' => $events]);
    }

    public function create_event()
    {
        return view('admin.create_event');
    }

    public function add_event(Request $request)
    {
        $data = new Event();
        $data->event_name = $request->name;
        $data->event_description = $request->event_description;
        $data->location = $request->location;
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->start_time = $request->start_time;
        $data->organizer = $request->organizer;

        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('event', $imagename);
            $data->image = $imagename;
        }

        $data->save();
        return redirect()->back();
    }

    public function view_event()
    {
        $data = Event::all();
        return view('admin.view_event', compact('data'));
    }

    public function event_delete($id)
    {
        $data = Event::findOrFail($id);
        $data->delete();
        return redirect()->back();
    }

    public function event_update($id)
    {
        $data = Event::findOrFail($id);
        return view('admin.update_event', compact('data'));
    }

    public function edit_event(Request $request, $id)
    {
        $data = Event::findOrFail($id);
        $data->category = $request->category;
        $data->event_name = $request->name;
        $data->event_description = $request->event_description;
        $data->location = $request->location;
        $data->date = $request->date;
        $data->start_time = $request->start_time;

        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('event', $imagename);
            $data->image = $imagename;
        }

        $data->save();
        return redirect()->back();
    }

    public function create_banner()
    {
        return view('admin.create_banner');
    }

    public function add_banner(Request $request)
    {
        $data = new Banner();

        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('gallery', $imagename);
            $data->image = $imagename;
        }

        $data->save();
        return redirect()->back();
    }

    public function about()
    {
        $data = About::first();

        // Pass the variable to the view
        return view('home.about', compact('data'));
    }

    public function add_about(Request $request, $about)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $about->description = $request->description;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('about_images'), $imageName);
            $about->image = $imageName;
        }

        $about->save();

        return redirect()->back()->with('success', 'About Us section added successfully.');
    }
}
