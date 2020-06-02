<?php

use Illuminate\Support\Facades\Route;

// Auth
Route::get('/', function()
{
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Articles
Route::get('/article', function()
{
    return view('articles.article');
});

Route::get('/about', function()
{
    $articles = App\Article::take(3)->latest()->get();

    return view('articles.about', compact('articles'));
});

Route::get('/contact', 'ContactController@create');
Route::post('/contact', 'ContactController@store');

Route::get('/articles', "ArticlesController@index")->name('articles.index');
Route::post('/articles', "ArticlesController@store");
Route::get('/articles/create', "ArticlesController@create")->name('articles.create');
Route::get('/articles/{article}', "ArticlesController@show")->name('articles.show');
Route::get('/articles/{article}/edit', "ArticlesController@edit")->name('articles.edit');
Route::put('/articles/{article}', "ArticlesController@update");

// Learn
Route::get('/v1/test', function()
{
    // Getting a GET request value
    $name = request('name');

    return view('learn.test', compact("name"));
});

Route::get('/v2/test', function(App\Collaborator $collaborator)
{
    ddd(
        config('app')
        , app("Example")
        , resolve('Example')
        , $collaborator
        , resolve('Collaborator')
        , resolve(App\Collaborator::class)
        , app()->make(App\Collaborator::class)
    );

    return view('welcome');
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

    return view('learn.post', compact("post"));
});

// Using a controller and accessing the database
Route::get('/v2/posts/{slug}', "PostsController@show");

Route::get('/payments/create', 'PaymentsController@create')->middleware('auth');
Route::post('/payments', 'PaymentsController@store');
