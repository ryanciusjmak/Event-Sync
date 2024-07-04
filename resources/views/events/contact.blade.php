@extends('layouts.main')

@section('title', 'Contact')

@section('content')
<div class="contact-container">
    <div class="contact-header">
        <h1>GET IN TOUCH</h1>
    </div>
    <div class="contact-content">
        <div class="contact-info">
            <h2>DO NOT BE SHY</h2>
            <p>Please feel free to contact me. I'm always open to discussing new projects, creative ideas or opportunities to be part of your visions.</p>
            <p><ion-icon name="mail-outline"></ion-icon> Send me: <a href="mailto:ryanciusjmak@gmail.com">ryanciusjmak@gmail.com</a></p>
            <p><ion-icon name="call-outline"></ion-icon> Call me: <a href="tel:+15998183449">+55 15 998183449</a></p>
        </div>
        <div class="contact-form">
            <form id="contactForm" action="{{ route('email.store') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Enter your Name" required>
                <input type="email" name="email" placeholder="Enter a valid email address" required>
                <textarea name="message" placeholder="Enter your message" required></textarea>
                <div class="terms">
                    <input type="checkbox" name="terms" id="terms" required>
                    <label for="terms">I accept the Terms of Service</label>
                </div>
                <button type="submit" class="btn btn-primary">ENVIAR</button>
            </form>
        </div>
    </div>
</div>
@endsection
