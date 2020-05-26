<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($post)
    {
        $posts = [
            'my-first-post' => "Hello, this is my first blog post",
            'my-second-post' => "Now i'm getting the hang of this blog thing",
        ];

        if (!array_key_exists($post, $posts)) {
            abort(404, "No post yet!");
        }

        $post = $posts[$post] ?? "No post yet!";

        return view('post', compact("post"));
    }
}
