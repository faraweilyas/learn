<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function()
{
    return view('welcome');
});

Route::get('/about', function()
{
    $articles = App\Article::take(3)->latest()->get();

    return view('about', compact('articles'));
});

Route::get('/articles', "ArticlesController@index")->name('articles.index');
Route::post('/articles', "ArticlesController@store");
Route::get('/articles/create', "ArticlesController@create")->name('articles.create');
Route::get('/articles/{article}', "ArticlesController@show")->name('articles.show');
Route::get('/articles/{article}/edit', "ArticlesController@edit")->name('articles.edit');
Route::put('/articles/{article}', "ArticlesController@update");

Route::get('/test', function()
{
    // Getting a GET request value
    $name = request('name');

    return view('test', compact("name"));
});

// Using a closure
Route::get('/v1/posts/{post}', function($post)
{
    $posts = [
        'my-first-post' => "Hello, this is my first blog post",
        'my-second-post' => "Now i'm getting the hang of this <b>blog</b> thing",
    ];

    if (!array_key_exists($post, $posts)) {
        abort(404, "No post yet!");
    }

    $post = $posts[$post] ?? "No post yet!";

    return view('post', compact("post"));
});

// Using a controller and accessing the database
Route::get('/v2/posts/{slug}', "PostsController@show");
