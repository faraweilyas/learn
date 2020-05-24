<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function()
{
    return view('welcome');
});

Route::get('/test', function()
{
    $name = request('name');

    return view('test', compact("name"));
});

Route::get('/posts/{post}', function($post)
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
});
