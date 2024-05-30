@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>My Events</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($events) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Participants</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                        <td> <!-- Aqui você pode adicionar o número de participantes, se houver --> </td>
                        <td> <!-- Aqui você pode adicionar ações, como editar ou deletar --> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You don't have events yet, <a href="/events/create">Create an event</a></p>
    @endif
</div>

@endsection
