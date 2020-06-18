<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
    <div class="mr-2 flex-shrink-0">
        <a href="{{ route('tweety.user_profile', $tweet->user) }}" title="{{ $tweet->user->name }}">
            <img
                class="rounded-full mr-2"
                src="{{ $tweet->user->avatar_path }}"
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
                {{ $tweet->user->name }}
                <x-verified :user='$tweet->user'></x-verified>
                <span class="text-sm font-light text-gray-600">{{ $tweet->user->getUsername() }}</span>
                <span class="font-light text-sm">· {{ $tweet->created_at->ago(null, true) }}</span>
            </a>
        </h5>
        <p class="text-sm mb-3">{{ $tweet->body }}</p>
        <x-like-dislike-butons :tweet='$tweet'></x-like-dislike-butons>
    </div>
</div>
