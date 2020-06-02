@extends('layouts.layout')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
@endsection('head')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <h2 class="heading has-text-weight-bold is-size-4">Contact Us</h2>
            <form action="/contact" method="POST">
                @csrf
                <div class="field">
                    <label class="label" for="email">Email:</label>
                    <div class="control">
                        <input
                            class="input @error('email') is-danger @enderror"
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}" required />
                        @error('email')
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @enderror
                        @if(session('message'))
                        <p class="help is-success">{{ session('message') }}</p>
                        @endif
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Email Me</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection('content')
