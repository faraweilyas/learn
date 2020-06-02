<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    public function show()
    {
        return view('mail-notifications.show', [
            'readNotifications'     => auth()->user()->readNotifications,
            'unreadNotifications'   => tap(auth()->user()->unreadNotifications)->markAsRead(),
        ]);
    }
}
