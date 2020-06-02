<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\PaymentRecieved;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{
    public function create()
    {
        return view('make-payment');
    }

    public function store()
    {
        Notification::send(request()->user(), new PaymentRecieved());
    }
}
