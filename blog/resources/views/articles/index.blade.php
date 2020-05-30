@extends('layouts.layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            @foreach ($articles as $article)
            <div id="content">
                <div class="title">
                    <h2><a href="{{ url(route('articles.show', $article)) }}">{{ $article->title }}</a></h2>
                </div>
                <p><img src="{{ asset('/assets/images/banner.jpg') }}" alt="{{ $article->excerpt }}" class="image image-full" /></p>
                <p>
                    <a href="{{ $article->path() }}">View</a>&nbsp;
                    <a href="{{ $article->editPath() }}">Edit</a>&nbsp;
                    <a href="{{ $article->deletePath() }}">Delete</a>
                </p>
                <p>{{ $article->excerpt }}</p>
            </div>
            @endforeach
        </div>
    </div>
@endsection('content')
