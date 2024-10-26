<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index()
    {
        $events = Event::with(['category', 'attendees'])->get();
        return EventResource::collection($events);
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(EventRequest $request)
    {
        $event = Event::create($request->validated());
        return new EventResource($event);
    }

    /**
     * Display the specified event.
     */
    public function show($id)
    {
        $event = Event::with(['category', 'attendees'])->findOrFail($id);
        return new EventResource($event);
    }

    /**
     * Update the specified event in storage.
     */
    public function update(EventRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update($request->validated());
        return new EventResource($event);
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->noContent();
    }
}
