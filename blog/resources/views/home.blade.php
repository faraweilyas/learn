@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Welcome, {{ auth()->user()->name }}!<br /><br />

                    You are logged in!<br /><br />

                    Name: {{ Auth::user()->name }}<br />
                    Email: {{ Auth::user()->email }}<br />
                    Date Created: {{ Auth::user()->created_at }}<br />
                    Last Updated: {{ Auth::user()->updated_at }}<br />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
