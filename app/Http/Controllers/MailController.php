<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.',
            'files' => [
                public_path('attachments/test-one.pdf'),
                public_path('attachments/test-two.png')
            ]
        ];

        $email = 'ziadwebalariqi@gmail.com';
        Mail::to($email)->send(new DemoMail($mailData));

        dd("Email is sent successfully.");
    }
}

