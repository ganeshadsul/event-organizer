<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Venue::paginate(20);
        return view('venue.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venue.create');
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
            'name' => 'required | string',
            'address' => 'required | string',
            'contact_number' => 'required | digits:10',
        ]);

        $is_venue_created = Venue::create($data);
        if($is_venue_created)
            return redirect()->route('venue.index')->with('message', 'New Venue created successfully.');
        else
            return redirect()->route('venue.index')->with('message', 'Something went wrong.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entry = Venue::findOrFail($id);
        return view('venue.edit', compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        $data = $request->validate([
            'name' => 'required | string',
            'address' => 'required | string',
            'contact_number' => 'required | string',
        ]);

        $venue->fill($data);
        if ($venue->save()) {
            return redirect()->route('venue.index')->with('message', 'New venue updated successfully.');
        }else {
            return redirect()->route('venue.index')->with('message', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('venue.index')->with('message', 'Venue Deleted.');
    }
}
