<h3 class="font-bold text-sm mb-4">{{ auth()->user()->countFollows() }} Following</h3>
<ul>
    @forelse(auth()->user()->follows as $following)
    <li class="mb-4">
        <div>
            <a href="{{ route('tweety.user_profile', $following) }}" class="flex items-center text-sm">
                <img
                    class="rounded-full mr-2"
                    src="{{ $following->avatar }}"
                    alt="{{ $following->name }}"
                    width='40'
                    height='40'
                />
                {{ $following->name }}
            </a>
        </div>
    </li>
    @empty
        <p class="p-4">No followings.</p>
    @endforelse
</ul>

<hr class="font-extrabold text-black-400 mb-3" />

<h3 class="font-bold text-sm mb-4">{{ auth()->user()->countFollowers() }} Followers</h3>
<ul>
    @forelse(auth()->user()->followers as $follower)
    <li class="mb-4">
        <div>
            <a href="{{ route('tweety.user_profile', $follower) }}" class="flex items-center text-sm">
                <img
                    class="rounded-full mr-2"
                    src="{{ $follower->avatar }}"
                    alt="{{ $follower->name }}"
                    width='40'
                    height='40'
                />
                {{ $follower->name }}
            </a>
        </div>
    </li>
    @empty
        <p class="p-4">No followers.</p>
    @endforelse
</ul>
