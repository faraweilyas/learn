<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($slug)
    {
        // $post = \DB::table('posts')->where("slug", $slug)->first();
        // if (is_null($post)) {
        //     abort(404, "No post yet!");
        // }
        $post = Posts::where("slug", $slug)->firstOrFail();

        return view('db-post', compact("post"));
    }
}
