<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user)
    {
        if (auth()->user()->is($user))
            return back();

        auth()->user()->toggleFollow($user);

        return back();
    }
}
