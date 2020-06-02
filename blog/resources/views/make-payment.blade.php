@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make payment</div>

                <div class="card-body">
                    Hello, {{ Auth::user()->name }} you can pay now<br />

                    <form action="/payments" method="POST">
                        @csrf

                        <button class="button is-link" type="submit">Pay</button>

                        {{-- <a href="/payments" class="button is-link">Pay</a> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
