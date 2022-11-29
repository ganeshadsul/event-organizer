<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Venue;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $venues = Venue::all();
        $artists = Artist::all();
        $genres = Genre::all();
        $events = Event::with('artist', 'genre', 'venue');
        if (!empty($request->artist_id)) {
            $events = $events->whereHas('artist', function($query) use($request) {
                return $query->where('id', $request->artist_id);
            });
        }
        if (!empty($request->venue_id)) {
            $events = $events->whereHas('venue', function($query) use($request) {
                return $query->where('id', $request->venue_id);
            });
        }

        if (! empty($request->genre_id)) {
            $events = $events->whereHas('genre', function($query) use($request) {
                return $query->where('id', $request->genre_id);
            });
        }
        if (! empty($request->title)) {
            $events = $events->where('title', 'LIKE', '%'.$request->title.'%');
        }                
        $events = $events->paginate(20);
        
        return view('event.index', compact('events', 'venues', 'artists', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $venues = Venue::all();
        $artists = Artist::all();
        $genres = Genre::all();

        return view('event.create', compact( 'venues', 'artists', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$data = $request->validate([
			'title' => 'required | string',
            'genre_id' => 'required', 
            'venue_id'  => 'required', 
            'artist_id'  => 'required', 
            'image'  => 'required|image|mimes:jpg,png,jpeg,gif,svg', 
            'description'  => 'required | string', 
            'amount'  => 'required', 
            'event_on'  => 'required',
        ]);

		// $data['event_on'] = Carbon::createFromFormat('d/m/Y', $request->event_on)->format('Y-m-d');

		$data['image'] = time() . '.' . $request->image->getClientOriginalExtension();
		$request->image->move(public_path('images/event-images'), $data['image']);

        $is_event_created = Event::create($data);
        if ($is_event_created) {
            return redirect()->route('event.index')->with('message', 'New Event Created Successfully.');
        }else {
            return redirect()->route('event.index')->with('message', 'Something Went Wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		// $event = Event::find
		$event = Event::with('artist','genre','venue')->findOrFail($id);
		$event->event_on = date('d-m-Y', strtotime($event->event_on));
        return view('event.event', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $venues = Venue::all();
        $artists = Artist::all();
        $genres = Genre::all();

        return view('event.edit', compact('event', 'venues', 'artists', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
		$data = $request->validate([
			'title' => 'required | string',
			'genre_id' => 'required',
			'venue_id'  => 'required',
			'artist_id'  => 'required',
			'image'  => 'nullable',
			'description'  => 'required | string',
			'amount'  => 'required',
			'event_on'  => 'required',
		]);
		// dd($data);
		if($request->file('image')){

			$data['image'] = time() . '.' . $request->image->getClientOriginalExtension();
			$request->image->move(public_path('images/event-images'), $data['image']);
		}

		// $is_event_created = Event::create($data);
		$event->fill($data);
		if ($event->save()) {
			return redirect()->route('event.index')->with('message', 'New Event Updated Successfully.');
		} else {
			return redirect()->route('event.index')->with('message', 'Something Went Wrong.');
		}
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('event.index')->with('message', 'Event Deleted.');
    }
}
