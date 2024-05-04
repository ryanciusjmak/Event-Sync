@extends('layouts.main')

@section('title', 'Register Event')

@section ('content')
    

    <div id="event-register-container" class="col-md-6 offset-md-3 mt-5">
        <h1>Register your Event</h1>
        <form action="/events" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="mt-3" for="title">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Type your e-mail">
            </div>
            <div class="form-group">
                <label class="mt-3" for="city">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Type your password">
            </div>
            <input type="submit" class="btn btn-primary mt-3" value="Create Register">
        </form>
    </div>
@endsection