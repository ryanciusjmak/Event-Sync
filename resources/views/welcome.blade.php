@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Search for an event</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
    </form>
</div>
<div id="events-container" class="col-md-10 mx-auto">
    @if ($search)
    <h2 class="text-left">Searching for: <strong>{{ $search }}</strong></h2>
    <p>Number of events found: <strong>{{ $eventCount }}</strong></p>
    @else
    <h2 class="text-left">Next events</h2>
    <p class="subtitle">See events created in the next few days</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-date">{{ date('d/m/Y', strtotime($event->date))}}</p>
                <p class="card-participants">X Participants</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary">Find out more about</a>
            </div>
        </div>
        @endforeach
        @if (count($events) == 0 && $search)
            <p>Unable to find any event with {{$search}}! <a href="/">See all events</a></p>
        @elseif(count($events) == 0)
        <p>There are no events available for you</p>
        @endif
    </div>
</div>

@endsection