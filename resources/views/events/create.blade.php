@extends('layouts.main')

@section('title', 'Create Event')

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3 mt-5">
        <h1>Create your Event</h1>
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
                <label class="mt-3" for="description">Description</label>
                <textarea class="form-control" name="description" id="description" placeholder="Description of the event"></textarea>
            </div>
            <div class="form-group">
                <label class="mt-3" for="description">Add Infrastructure Items</label>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Chairs"> Chairs
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Stage"> Stage
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open Food"> Open Food
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Free beer"> Free beer
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Gifts"> Gifts
                </div>
            </div>
            <div class="form-group">
                <label class="mt-3" for="image">Add Photo</label>
                <input type="file" class="form-control-file mt-3" id="image" name="image"> 
            </div>
            <input type="submit" class="btn btn-primary mt-3" value="Create Event">
        </form>
    </div>
@endsection
