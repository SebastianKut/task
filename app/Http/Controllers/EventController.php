<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)

    {

        $validatedData = $request->validate([
            'name'          => ['required', 'string'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date'],
            'status'        => ['required', 'numeric'],
        ]);

        Event::create([
            'host_id'       => auth()->id(),
            'name'          => $validatedData['name'],
            'start_date'    => $validatedData['start_date'],
            'end_date'      => $validatedData['end_name'],
            'status'        => $validatedData['status'],
            'slug'          => str_replace(' ', '-', $validatedData['name']),
        ]);

        return response('Event created successfully.', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function update(Request $request, Event $event)

    {

        $validatedData = $request->validate([
            'name'          => ['required', 'string'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date'],
            'status'        => ['required', 'numeric'],
        ]);

        $event->save([
            'name'          => $validatedData['name'],
            'start_date'    => $validatedData['start_date'],
            'end_date'      => $validatedData['end_name'],
            'status'        => $validatedData['status'],
            'slug'          => str_replace(' ', '-', $validatedData['name']),
        ]);

        return response('Event updated successfully.', 200)
            ->header('Content-Type', 'text/plain');
    }
}
