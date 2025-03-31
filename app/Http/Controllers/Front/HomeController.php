<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Contact;




class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $events = Event::query()->paginate(6);


        return view('home.index')->with([
            'events' => $events,
        ]);



    }
    public function event_details($id){
        $event = Event::query()->find($id);

        return view('home.event_details',compact('event'));
    }
    public function add_booking(request $request, $id){


        $data = new Booking();
        $data->event_id = $id;
        $data->name= $request->name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->start_date= $request->startDate;
        $data->end_date= $request->endDate;
        $data->save();
        return redirect()->back()->with('message','event added successfully');
    }


    public function contact(Request $request)
    {

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;

        $saved = $contact->save();

        if ($saved) {
            return redirect()->back()->with('success', 'Message saved!');
        } else {
            return redirect()->back()->with('error', 'Failed to save message.');
        }

    }
    public function search( Request $request )
    {
        if( $request->has('search') ) {
            $search = $request->search;
            $events = Event::where('location', 'like', '%' . $request->search . '%')->paginate(5);
            return view('home.index', compact('events'));

        }else{
            return redirect()->back()->with('message','Empty search');

        }
    }
    public function index()
    {
        $usertype = auth()->user()->usertype;
        if ($usertype == 'admin') {
            return redirect()->route('admin.home');
        }
        else{
            return redirect()->route('home.index');
        }
    }
    public function book(Request $request, $id){
        $data = new Booking;
        $data->event_id = $id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->date = $request->date;
        dd($request->all());

       // $data-> save();
        //return redirect()->back();

    }
}
