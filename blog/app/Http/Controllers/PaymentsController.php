<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\PaymentRecieved;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{
    public function create()
    {
        return view('mail-notifications.make-payment');
    }

    public function store()
    {
        $message    = '';
        $amount     = (int) request()->validate([
                        'amount' => 'required|integer',
                    ])['amount'];
        try
        {
            // Notification::send(request()->user(), new PaymentRecieved($amount));
            request()->user()->notify(new PaymentRecieved($amount));
            $message = 'Payment notification sent!';
        }
        catch (\Swift_TransportException $exception)
        {
            $message = $exception->getMessage();
        }
        return redirect('/payments/create')->with('message', $message);
    }
}
