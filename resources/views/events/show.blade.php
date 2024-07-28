@extends('layouts.main')

@section('title', $event->title)

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $event->title }}</h1>
                <p class="event-city"><ion-icon name="location"></ion-icon>Location: {{ $event->city }}</p>
                <p class="events-participants"><ion-icon name="people"></ion-icon>Participants: {{ count($event->users) }}</p>
                <p class="event-owner"><ion-icon name="star"></ion-icon> Event Owner: {{ $eventOwner['name'] }}</p>
                <p><ion-icon name="{{ $event->private ? 'lock-closed' : 'lock-open' }}"></ion-icon>
                    {{ $event->private ? 'This event is private, buy the ticket.' : 'This event is public.' }}</p>

                <!-- Adicione esta linha para exibir o valor do evento -->
                <p class="event-price"><ion-icon name="cash"></ion-icon> Ticket Price: ${{ number_format($event->price, 2) }}</p>

                @if (!$hasUserJoined && !$event->private)
                    <form action="/events/join/{{ $event->id }}" method="POST">
                        @csrf
                        <a href="#" class="btn btn-primary" id="event-submit"
                            onclick="event.preventDefault(); this.closest('form').submit();">Confirm Attendance</a>
                    </form>
                @elseif($hasUserJoined)
                    <p class="already-joined-msg">You are already participating!</p>
                @endif

                @php
                    $ticketPurchased = \App\Models\TicketPurchase::where('user_id', auth()->id())
                        ->where('event_id', $event->id)
                        ->exists();
                @endphp

                @if ($event->private && !$event->free)
                    @if ($ticketPurchased)
                        <p class="already-purchased-msg">Você comprou este bilhete.</p>
                    @else
                        <form action="/session" method="POST">
                            @csrf
                            <input type="hidden" name="total" value="{{ $event->price }}">
                            <input type="hidden" name="productname" value="{{ $event->title }}">
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <button class="btn btn-primary mt-3 mb-3" type="submit">Buy Ticket</button>
                        </form>
                    @endif
                @endif

                <h3>The event has:</h3>
                @if ($event->items)
                    <ul id="items-list">
                        @foreach ($event->items as $item)
                            <li><ion-icon name="rocket"></ion-icon> <span>{{ $item }}</span></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-md-12" id="description-container">
                <h3>About the event:</h3>
                <p class="event-description">{{ $event->description }}</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/disableSubmit.js') }}"></script>
@endsection
