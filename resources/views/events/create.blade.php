@extends('layouts.main')

@section('title', 'Create Event')

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center">Create your Event</h1>
        <form action="/events" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="mt-3" for="title">Event:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Event Name">
            </div>
            <div class="form-group">
                <label class="mt-3" for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Event's place">
            </div>
            <div class="form-group">
                <label class="mt-3" for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <div class="form-group">
                <label class="mt-3" for="private">Is the event private?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                </select>
            </div>
            <div class="form-group">
    <label class="mt-3" for="description">Add Infrastructure Items</label>
    <div class="row">
        <div class="col-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="items[]" value="Chairs" id="chairs">
                <label class="form-check-label ms-2" for="chairs">Chairs</label>
            </div>
        </div>
        <div class="col-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="items[]" value="Stage" id="stage">
                <label class="form-check-label ms-2" for="stage">Stage</label>
            </div>
        </div>
        <div class="col-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="items[]" value="Open Food" id="open-food">
                <label class="form-check-label ms-2" for="open-food">Open Food</label>
            </div>
        </div>
        <div class="col-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="items[]" value="Free beer" id="free-beer">
                <label class="form-check-label ms-2" for="free-beer">Free Beer</label>
            </div>
        </div>
        <div class="col-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="items[]" value="Gifts" id="gifts">
                <label class="form-check-label ms-2" for="gifts">Gifts</label>
            </div>
        </div>
    </div>
</div>
            <div class="form-group">
                <label class="mt-3 " for="image">Add Photo</label>
                <input type="file" class="form-control-file mt-3 ms-2" id="image" name="image"> 
            </div>
            <div class="text-center"> 
                <input type="submit" class="btn btn-primary mt-3" value="Create Event" id="create-button">
            </div>
        </form>
    </div>
@endsection
