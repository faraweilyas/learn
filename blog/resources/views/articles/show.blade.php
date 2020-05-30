@extends('layouts.layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="title">
                    <h2>{{ $article->title }}</h2>
                </div>
                <p><img src="{{ asset('/assets/images/banner.jpg') }}" alt="" class="image image-full" /></p>
                <p>
                    <a href="{{ $article->editPath() }}">Edit</a>&nbsp;
                    <a href="{{ $article->deletePath() }}">Delete</a>
                </p>
                <p>{{ $article->body }}</p>
            </div>
        </div>
    </div>
@endsection('content')
