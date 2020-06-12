@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>
                <a href="/conversations">Back</a>
            </p>

            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <h2>{{ $conversation->title }}</h2>

            <p class="text-muted">Posted By: <b>{{ $conversation->user->name }}</b></p>

            <div>{{ $conversation->body }}</div>

            <hr />

            @include ('conversations.replies')
        </div>
    </div>
</div>
@endsection
