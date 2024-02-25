<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailToAll;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendToAll(): string
    {
        SendEmailToAll::dispatch();

        return 'Email sent to all users';
    }
}