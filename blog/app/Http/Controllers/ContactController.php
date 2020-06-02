<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Mail\ContactMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('articles.contact');
    }

    public function store(Request $request)
    {
        request()->validate([
            'email' => 'required|email'
        ]);

        // Mail::raw("It works!", function($message) use ($request)
        // {
        //     $message->to($request->email)
        //         ->subject('Hello There');
        // });

        Mail::to($request->email)->send(new Contact());
        // Mail::to($request->email)->send(new ContactMe("sandals"));

        return redirect('/contact')->with('message', 'Email Sent!');

        // $this->validateArticle();

        // $article = new Article(request(['title', 'excerpt', 'body']));
        // $article->user_id = 1; // auth()->id;
        // $article->save();

        // if (request()->has('tags')) {
        //     $article->tags()->attach(request('tags')); // [1,2,3]
        // }

        // return redirect(route('articles.index'));
    }
}
