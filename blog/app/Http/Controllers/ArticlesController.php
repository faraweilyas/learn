<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::latest()->get();
        }

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store()
    {
        $this->validateArticle();

        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1; // auth()->id;
        $article->save();

        if (request()->has('tags')) {
            $article->tags()->attach(request('tags')); // [1,2,3]
        }

        // dd(request()->all(), $article);
        // Article::create($this->validateArticle());
        // $article = App\Article::find(5);
        // $article->tags()->attach(1);
        // $article->tags()->attach([2,3]);
        // $article->tags()->dettach(1);
        // $article->tags()->dettach([2,3]);
        // $tag = App\Tag::find(1);
        // $article->tags()->attach($tag);
        // $tags = App\Tag::findMany([3,4]);
        // $article->tags()->attach($tags);

        return redirect(route('articles.index'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
        $article->update($this->validateArticle());

        return redirect($article->path());
    }

    public function destroy()
    {
        //
    }

    public function validateArticle()
    {
        return request()->validate([
            'title'     => 'required',
            'excerpt'   => 'required',
            'body'      => 'required',
            'tags'      => 'exists:tags,id',
        ]);
    }
}
