<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendmail;

class SendmailController extends Controller
{
    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $data = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ];

        Mail::to($email)->send(new Sendmail($data));

        return redirect('/events/contact')->with('msg', 'Email successfully sent!');
    }

}


