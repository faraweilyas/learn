@foreach ($conversation->replies as $reply)

    <div>
        <header style="display: flex; justify-content: space-between;">

            <p class="m-0"><strong>{{ $reply->user->name }} said...</strong></p>

            <span style="color: green;">{{ ($conversation->best_reply_id == $reply->id) ? "Best!" : "" }}</span>

        </header>

        {{ $reply->body }}


        @can ('update-coversation', $conversation)
            <form method="POST" action="/best-replies/{{ $reply->id }}">
                @csrf
                <button type="submit" class="btn p-0 text-muted">Best Reply?</button>
            </form>
        @endcan
    </div>

    @continue($loop->last)

    <hr />

@endforeach
