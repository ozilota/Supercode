<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function send($name, $title)
    {
        $array = [
            'name' => $name,
            'title' => $title,
            'date' => Carbon::now(+3)
        ];

        mail::send('mail.mailToAuthorized', $array, function ($message) {
            $message->subject('Yeni Ticket');
            $message->to('bilgiislem@tfo.k12.tr');
        });

        mail::send('mail.mailToOwnself', $array, function ($message) {
            $message->subject('Yeni Ticket');
            $message->to(Auth::user()->email);
        });
    }
}
