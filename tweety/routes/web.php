<?php

use Illuminate\Support\Facades\Route;

// auth()->loginUsingId(3);

// DB::listen(function($query)
// {
//     dump($query->sql, $query->bindings);
// });

Route::get('/', function()
{
    return view('welcome');
});

Route::middleware('auth')->group(function()
{
    Route::get(
        '/tweets',
        'TweetController@index'
    )
    ->name('tweety.home');

    Route::post(
        '/tweets',
        'TweetController@store'
    )
    ->name('tweety.tweet');

    Route::post(
        '/profiles/{user:username}/follow',
        'FollowController@store'
    )
    ->name('tweety.user_follow');

    Route::get(
        '/profiles/{user:username}/edit',
        'ProfileController@edit'
    )
    ->name('tweety.user_edit')
    ->middleware('can:edit,user');

    Route::patch(
        '/profiles/{user:username}',
        'ProfileController@update'
    )
    ->name('tweety.user_update')
    ->middleware('can:edit,user');

    Route::get(
        '/explore',
        'ExploreController@index'
    )
    ->name('tweety.explore');
});

Route::get(
    '/profiles/{user:username}',
    'ProfileController@show'
)
->name('tweety.user_profile');

Auth::routes();
