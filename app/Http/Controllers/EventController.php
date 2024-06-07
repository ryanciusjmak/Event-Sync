<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\Title;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function index() {
        $search = request('search');
    
        if ($search) {
            $events = Event::where('title', 'like', '%'.$search.'%')->get();
        } else {
            $events = Event::all();
        }

        $eventCount = $events->count();
    
        return view('welcome', ['events' => $events, 'search' => $search, 'eventCount' => $eventCount]);
    }

    public function register() {
        return view('events.register');
    }

    public function create() {
        return view('events.create');
    }

    public function show($id) {
        try {
            $event = Event::findOrFail($id);
            $eventOwner = User::where('id', $event->user_id)->first()->toArray();

            return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
        } catch (ModelNotFoundException $e) {
            return response()->view('events.erro', [], 404);
        } catch (NotFoundHttpException $e) {
            return response()->view('events.erro', [], 404);
        }
    }

    public function store(Request $request) {
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function dashboard() {
        $user = auth()->user();
        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);
    }

    public function destroy($id) {
        try {
            Event::findOrFail($id)->delete();
            return redirect('/dashboard')->with('msg', 'Event deleted successfully!');
        } catch (ModelNotFoundException $e) {
            return response()->view('events.erro', [], 404);
        } catch (NotFoundHttpException $e) {
            return response()->view('events.erro', [], 404);
        }
    }

    public function edit($id) {
        try {
            $event = Event::findOrFail($id);
            return view('events.edit', ['event' => $event]);
        } catch (ModelNotFoundException $e) {
            return response()->view('events.erro', [], 404);
        } catch (NotFoundHttpException $e) {
            return response()->view('events.erro', [], 404);
        }
    }

    public function update(Request $request) {

        $data = $request->all();

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Event edited successfully!');
    }

    public function joinEvent($id) {
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Your presence is confirmed at the event ' . $event->title);
    }
}
