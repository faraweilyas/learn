<h3 class="font-bold text-sm mb-4">{{ $user->countFollows() }} Following</h3>
<ul>
    @forelse($user->follows as $following)
    <li class="{{ $loop->last ? '' : 'mb-4' }}">
        <div class="">
            <a href="{{ route('tweety.user_profile', $following) }}" class="flex items-center text-sm">
                <img
                    class="rounded-full mr-2"
                    src="{{ $following->avatar_path }}"
                    alt="{{ $following->name }}"
                    width='40'
                    height='40'
                />
                {{ $following->name }}&nbsp;
                <x-verified :user='$following'></x-verified>
                {{-- <span class="text-gray-700">{{ $following->getUsername() }}</span> --}}
            </a>
        </div>
    </li>
    @empty
        <p class="p-4">No followings.</p>
    @endforelse
</ul>

<hr class="font-extrabold text-black-400 mb-3 mt-3" />

<h3 class="font-bold text-sm mb-4">{{ $user->countFollowers() }} Followers</h3>
<ul>
    @forelse($user->followers as $follower)
    <li class="{{ $loop->last ? '' : 'mb-4' }}">
        <div>
            <a href="{{ route('tweety.user_profile', $follower) }}" class="flex items-center text-sm">
                <img
                    class="rounded-full mr-2"
                    src="{{ $follower->avatar_path }}"
                    alt="{{ $follower->name }}"
                    width='40'
                    height='40'
                />
                {{ $follower->name }}&nbsp;
                <x-verified :user='$follower'></x-verified>
            </a>
        </div>
    </li>
    @empty
        <p class="p-4">No followers.</p>
    @endforelse
</ul>
