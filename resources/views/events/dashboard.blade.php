@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>My Events</h1>
</div>
<div class="col-md-8 offset-md-2 dashboard-events-container">
    @if (count($events) > 0)
    <table class="table custom-table">
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
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                <td>{{ count($event->users) }}</td>
                <td class="custom-mid">
                    <a href="/events/edit/{{$event->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Edit</a>
                    <form action="/events/{{$event->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You don't have events yet <a href="/events/create">Create an event</a></p>
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container mt-5 mb-1">
    <h1>Events I Signed Up For</h1>
</div>
<div class="col-md-8 offset-md-2 dashboard-events-container">
    @if (count($eventsasparticipant) > 0)
    <table class="table custom-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Participants</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventsasparticipant as $event)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                <td>{{ count($event->users) }}</td>
                <td class="custom-mid">
                    <form action="/events/leave/{{$event->id}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="walk"></ion-icon>Exit</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You are not participating in any events yet <a href="/">See all events here</a></p>
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container mt-5 mb-1">
    <h1>Tickets Purchased</h1>
</div>
<div class="col-md-8 offset-md-2 dashboard-events-container">
    @if (count($ticketPurchases) > 0)
    <table class="table custom-table">
        <thead>
            <tr>
                <th scope="col">Event Name</th>
                <th scope="col">Purchase Date</th>
                <th scope="col">Amount Paid</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketPurchases as $purchase)
            <tr>
                <td><a href="/events/{{ $purchase->event->id }}">{{ $purchase->event->title }}</a></td>
                <td>{{ $purchase->created_at->format('d/m/Y') }}</td>
                <td>${{ $purchase->amount_paid }}</td>
                <td class="custom-mid">
                    <a href="/events/{{ $purchase->event->id }}" class="btn btn-danger"><ion-icon name="create-outline"></ion-icon>Event</a>
                    <form action="/tickets/refund/{{$purchase->id}}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning"><ion-icon name="walk"></ion-icon>Refund</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You haven't purchased any tickets yet <a href="/">See all events here</a></p>
    @endif
</div>

@endsection
