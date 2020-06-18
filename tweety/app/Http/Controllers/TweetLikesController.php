<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetLikesController extends Controller
{
    public function store(Tweet $tweet)
    {
        $tweet->like();

        return redirect()->back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->dislike();

        return redirect()->back();
    }
}
