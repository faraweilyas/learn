@extends('layouts.layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            @forelse ($articles as $article)
            <div id="content">
                <div class="title">
                    <h2><a href="{{ url(route('articles.show', $article)) }}">{{ $article->title }}</a></h2>
                </div>
                <p><img src="{{ asset('/assets/images/banner.jpg') }}" alt="{{ $article->excerpt }}" class="image image-full" /></p>
                <p class="float_left">
                    @foreach($article->tags as $tag)
                        <a href="{{ $tag->pathToarticlesWithTag() }}">{{ $tag->name }}</a>
                    @endforeach
                </p>
                <p class="float_right">
                    <a href="{{ $article->path() }}">View</a>&nbsp;
                    <a href="{{ $article->editPath() }}">Edit</a>&nbsp;
                    <a href="{{ $article->deletePath() }}">Delete</a>
                </p>
                <div class="clear"></div>
                <p>{{ $article->excerpt }}</p>
            </div>
            @empty
                <p>No relevant articles yet, <a href="">Go back</a>.</p>
            @endforelse
        </div>
    </div>
@endsection('content')
