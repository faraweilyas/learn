<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Support\Facades\View;

class PostsController extends Controller
{
    public function show($slug)
    {
        // $post = \DB::table('posts')->where("slug", $slug)->first();
        // if (is_null($post)) {
        //     abort(404, "No post yet!");
        // }
        $post = Posts::where("slug", $slug)->firstOrFail();

        // return view('learn.db-post', compact("post"));
        return View::make('learn.db-post', compact("post"));
    }
}
