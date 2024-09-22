@extends('layouts.main')

@section('title', 'Editing: ' . $event->title)

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center">Editing: {{ $event->title }}</h1>
        <form action="/events/update/{{$event->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="mt-3" for="title">Event:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Event Name" value="{{$event->title}}">
            </div>
            <div class="form-group">
                <label class="mt-3" for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Event's place" value="{{$event->city}}">
            </div>
            <div class="form-group">
                <label class="mt-3" for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{date('Y-m-d', strtotime($event->date))}}">
            </div>
            <div class="form-group">
                <label class="mt-3" for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" placeholder="Event Description" required>{{$event->description}}</textarea>
            </div>
            <div class="form-group">
                <label class="mt-3" for="private">Is the event private?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">NO</option>
                    <option value="1" {{$event->private == 1 ? "selected='selected'" : ""}}>YES</option>
                </select>
            </div>
            <div class="form-group">
                <label class="mt-3" for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Event Price" value="{{ $event->price }}">
            </div>
            <div class="form-group">
                <label class="mt-3 " for="image">Add Photo</label>
                <input type="file" class="form-control-file mt-3 ms-2" id="image" name="image"> 
                <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview">
            </div>
            <div class="text-center"> 
                <input type="submit" class="btn btn-primary mt-3" value="Edit Event" id="create-button">
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/disableSubmit.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>
@endsection
