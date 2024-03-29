<x-app :user='$user'>
    <div>
        <header class="mb-6 relative">

            <div class="relative">
                <img
                    class='mb-2 rounded-lg'
                    style='width: 700px; height: 223px;'
                    src="/images/default-profile-banner.jpg"
                    alt="{{ $user->name }}'s banner"
                />

                <img
                    style='width: 150px; left: 50%; transform: translateX(-50%) translateY(50%);'
                    class="rounded-full mr-2 absolute bottom-0"
                    src="{{ $user->avatar_path }}"
                    alt="{{ $user->name }}"
                />
            </div>

            <div class="flex justify-between items-center mb-6">
                <div style="max-width: 270px;">
                    <h2 class="font-bold text-2xl mb-0">
                        {{ $user->name }}
                        <x-verified :user='$user'></x-verified>
                    </h2>
                    <p class="font-bold text-sm italic text-blue-800">{{ $user->getUsername() }}</p>

                    @if (auth()->user()->is($user))
                        <p class="font-bold text-sm mt-2 text-blue-800">{{ $user->email }}</p>
                    @endif

                    <p class="text-sm mt-2">Joined {{ $user->created_at->diffForHumans() }}</p>

                    <p class="text-sm mt-2 hover:underline font-bold text-blue-800">
                        {{ $user->tweets()->count() }} Tweets
                    </p>

                    <p class="text-sm mt-2 italic">
                        <a class="hover:underline mr-2" href="">
                            <span class="font-bold text-blue-800">{{ $user->countFollows() }}</span> Following
                        </a>
                        <a class="hover:underline" href="">
                            <span class="font-bold text-blue-800">{{ $user->countFollowers() }}</span> Followers
                        </a>
                    </p>
                </div>

                <div class="flex">
                    @can ('edit', $user)
                        <a
                            href="{{ route("tweety.user_edit", $user) }}"
                            class="rounded-full border border-gray-300 py-2 px-2 text-black text-xs mr-2"
                        >
                            Edit Profile
                        </a>
                    @endcan

                    @if (auth()->user()->isNot($user))
                        <x-follow_form :user='$user'></x-follow_form>
                    @endif
                </div>
            </div>

            <p class="text-sm">Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah Blah</p>
        </header>

        @include('_timeline', [
            'tweets' => $tweets
        ])
    </div>
</x-app>
