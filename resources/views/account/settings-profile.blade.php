@extends('layouts.main')

@section('title', 'Settings')

@section('content')

<div class="profile-settings">
    <div><h1 class="text-white">Profile</h1></div>
    <form action="{{ route('account.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="form-group text-white">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>
    
        <div class="form-group text-white">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        </div>
    
        <div class="form-group text-white">
            <label for="profile_picture">Profile Photo</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
        </div>
    
        <button type="submit">Update Profile</button>
    </form>
</div>


@endsection