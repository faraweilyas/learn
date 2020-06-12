<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ProductPurchased;
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
        catch (\Exception $exception)
        {
            // \Swift_TransportException
            // \Http\Client\Exception\NetworkException
            // \Http\Client\Exception\RequestException
            // ddd(get_class($exception), $exception);

            $type       = (get_class($exception) == "Swift_TransportException") ? "Mail: " : "SMS: ";
            $message    = $type.$exception->getMessage();
        }

        // ProductPurchased::dispatch($amount);
        // event(new ProductPurchased($amount));

        // dd($message);
        return redirect('/payments/create')->with('message', $message);
    }
}
