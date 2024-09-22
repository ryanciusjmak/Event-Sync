<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\Title;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $events = Event::where('title', 'like', '%' . $search . '%')->get();
        } else {
            $events = Event::all();
        }

        // Para cada evento, atualize a contagem de participantes
        foreach ($events as $event) {
            $event->participant_count = $event->users()->count();
        }

        $eventCount = $events->count();

        return view('welcome', ['events' => $events, 'search' => $search, 'eventCount' => $eventCount]);
    }

    public function register()
    {
        return view('events.register');
    }

    public function create()
    {
        return view('events.create');
    }

    public function contact()
    {
        return view('events.contact');
    }


    public function show($id)
    {
        try {
            $event = Event::findOrFail($id);
            $user = auth()->user();
            $hasUserJoined = false;
            if ($user) {
                $userEvents = $user->eventsAsParticipant->toArray();
                foreach ($userEvents as $userEvent) {
                    if ($userEvent['id'] == $id) {
                        $hasUserJoined = true;
                    }
                }
            }
            $eventOwner = User::where('id', $event->user_id)->first()->toArray();

            return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
        } catch (ModelNotFoundException $e) {
            return response()->view('events.erro', [], 404);
        } catch (NotFoundHttpException $e) {
            return response()->view('events.erro', [], 404);
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'city' => 'required',
            'private' => 'required',
            'description' => 'required',
            'price' => 'nullable|numeric|min:0',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $request->all();

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        $event->price = $request->price ?? 0;
        $event->latitude = $request->latitude;
        $event->longitude = $request->longitude;
        

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        } else {

            $event->image = 'default_image.jpg';
        }


        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;
        $ticketPurchases = $user->ticketPurchases;

        return view('events.dashboard', [
            'events' => $events,
            'eventsasparticipant' => $eventsAsParticipant,
            'ticketPurchases' => $ticketPurchases  // Passa ingressos comprados para a view
        ]);
    }

    public function dashboardData()
    {
        $events = Event::select('title', 'city', 'latitude', 'longitude')->get();

        return view('maps', compact('events'));
    }

    public function destroy($id)
    {
        try {
            Event::findOrFail($id)->delete();
            return redirect('/dashboard')->with('msg', 'Event deleted successfully!');
        } catch (ModelNotFoundException $e) {
            return response()->view('events.erro', [], 404);
        } catch (NotFoundHttpException $e) {
            return response()->view('events.erro', [], 404);
        }
    }

    public function edit($id)
    {
        try {
            $event = Event::findOrFail($id);

            $user = auth()->user();

            if ($user->id != $event->user_id) {
                return redirect('/dashboard');
            }

            return view('events.edit', ['event' => $event]);
        } catch (ModelNotFoundException $e) {
            return response()->view('events.erro', [], 404);
        } catch (NotFoundHttpException $e) {
            return response()->view('events.erro', [], 404);
        }
    }

    public function update(Request $request)
{
    // Valida os dados recebidos
    $request->validate([
        'title' => 'required',
        'date' => 'required',
        'city' => 'required',
        'private' => 'required',
        'description' => 'required',
        'price' => 'nullable|numeric|min:0',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'items' => 'nullable|string',
    ]);

    // Prepara os dados para atualização
    $data = $request->all();

    // Processa o upload da imagem
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $requestImage = $request->image;
        $extension = $requestImage->extension();
        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

        $requestImage->move(public_path('img/events'), $imageName);
        $data['image'] = $imageName;
    } else {
        // Verifica se a imagem já existe no evento e define uma imagem padrão se necessário
        $existingEvent = Event::findOrFail($request->id);
        if (!$existingEvent->image) {
            $data['image'] = 'default_image.jpg';
        }
    }

    // Define valor padrão para 'items' se não estiver presente
    if (!isset($data['items'])) {
        $data['items'] = ''; // Ou um valor padrão apropriado
    }

    // Atualiza o evento
    Event::findOrFail($request->id)->update($data);

    return redirect('/dashboard')->with('msg', 'Event edited successfully!');
}

    public function joinEvent($id)
    {
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Your presence is confirmed at the event ' . $event->title);
    }

    public function leaveEvent($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);
        $user->eventsAsParticipant()->detach($id);

        return redirect('/dashboard')->with('msg', 'You successfully left the event ' . $event->title);
    }
}
