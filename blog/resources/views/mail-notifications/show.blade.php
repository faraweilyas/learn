@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notifications</div>
                <div class="card-body">
                    <p>Unread Notifications</p>
                    <ul>
                        @forelse ($unreadNotifications as $unreadNotification)
                            @if ($unreadNotification->type == "App\Notifications\PaymentRecieved")
                                <li>We have recieved a payment of {!! formatAmount($unreadNotification->data['amount'] ?? 0, TRUE) !!}.</li>
                            @endif
                        @empty
                            <li>No unread notification(s) at the moment.</li>
                        @endforelse
                    </ul>
                    <hr />
                    <p>Read Notifications</p>
                    <ul>
                        @forelse ($readNotifications as $readNotification)
                            @if ($readNotification->type == "App\Notifications\PaymentRecieved")
                                <li>We have recieved a payment of {!! formatAmount($readNotification->data['amount'] ?? 0, TRUE) !!}.</li>
                            @endif
                        @empty
                            <li>No relevant notification(s) at the moment.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
