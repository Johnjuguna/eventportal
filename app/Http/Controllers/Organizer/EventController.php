<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event; // Ensure this is correct


class EventController extends Controller
{
    // Show event creation form
    public function create()
    {
        return view('organizer.events.create');
    }

// Store new event in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string',
        ]);
        Event::create($request->all());

        return redirect()->route('organizer.events.manage')->with('success', 'Event created successfully.');
    }

    // Show events for editing or deletion
    public function manage()
    {
        $events = Event::all();
        return view('organizer.events.manage', compact('events'));
    }

    // Show event edit form


    // Update event details


    // Delete an event
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('organizer.events.update')->with('success', 'Event deleted successfully.');
    }

    public function showupdatepage()
    {
        $events = Event::all(); // Fetch all events
        return view('organizer.events.update', compact('events'));
    }



    public function update(Request $request, $id)
    {
        $organizerId = Auth();
        $event = Event::where('id', $id)->where('organizer_id', $organizerId)->first();

        if (!$event) {
            return redirect()->route('organizer.events.update')->
            with('error', 'Unauthorized access!');
        }
        $request->validate([
            'name'=> 'required',
            'category' => 'required|string',
            'description' => 'required|string',
            'location' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
        ]);
        $event = Event::findOrFail($id);
        $event->category = $request->category;
        $event->event_name = $request->name;
        $event->event_description = $request->event_description;
        $event->location = $request->location;
        $event->date = $request->date;
        $event->start_time = $request->start_time;


    }
    public function edit($id)
    {
        $organizerId = Auth::id();
        $event = Event::where('id', $id)->where('organizer_id', $organizerId)->first();
        if (!$event) {
            return redirect()->route('organizer.events.update')->with('error', 'Unauthorized access!');
    }
        return view('organizer.events.edit', compact('event'));

}
}

