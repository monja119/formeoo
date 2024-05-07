<?php

namespace App\Http\Controllers;

use App\Mail\MailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $data = $request->get('data');

        // sending mail
        Mail::to($data['email'])->send(new MailMessage($data));

        // redirecting to user controller
        return redirect()->route('user')->with(['message' => $data]);

    }
}
