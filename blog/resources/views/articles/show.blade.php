@extends('layouts.layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="title">
                    <h2>{{ $article->title }}</h2>
                </div>
                <p>
                    <img src="{{ asset('/assets/images/banner.jpg') }}" alt="" class="image image-full" />
                </p>
                <p class="float_left">
                    @foreach($article->tags as $tag)
                        <a href="{{ $tag->pathToarticlesWithTag() }}">{{ $tag->name }}</a>
                    @endforeach
                </p>
                <p class="float_right">
                    <a href="{{ $article->editPath() }}">Edit</a>&nbsp;
                    <a href="{{ $article->deletePath() }}">Delete</a>
                </p>
                <div class="clear"></div>
                <p>{{ $article->body }}</p>
            </div>
        </div>
    </div>
@endsection('content')
