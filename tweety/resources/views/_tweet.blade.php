<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
    <div class="mr-2 flex-shrink-0">
        <a href="{{ route('tweety.user_profile', $tweet->user) }}" title="{{ $tweet->user->name }}">
            <img
                class="rounded-full mr-2"
                src="{{ $tweet->user->avatar }}"
                alt=""
                width='40'
                height='40'
            />
        </a>
    </div>

    <div>
        <h5 class="font-bold mb-4">
            <a href="{{ route('tweety.user_profile', $tweet->user) }}">
                {{-- &diams; --}}
                {{ $tweet->user->name }} <span class="font-light text-sm">· {{ $tweet->created_at->ago(null, true) }}</span>
            </a>
        </h5>
        <p class="text-sm">{{ $tweet->body }}</p>
    </div>
</div>
