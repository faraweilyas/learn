<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Support\Facades\View;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Cache;

class PostsController extends Controller
{
    public function show($slug, Filesystem $file)
    {
        // Cache::remember('foo', 60, function()
        // {
        //     return 'foobar';
        // });

        // return Cache::get('foo');

        // return $file->get(public_path()."/index.php");

        // $post = \DB::table('posts')->where("slug", $slug)->first();

        // if (is_null($post)) {
        //     abort(404, "No post yet!");
        // }

        $post = Posts::where("slug", $slug)->firstOrFail();

        // return view('learn.db-post', compact("post"));
        return View::make('learn.db-post', compact("post"));
    }
}
