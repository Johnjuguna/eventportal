<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class OrganizerController extends Controller
{
    public function index()
    {
        return view('organizer.index');
    }

    public function update($id)
    {
        $data = Event::findOrFail($id);
        return view('organizer.update', compact('data'));
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
