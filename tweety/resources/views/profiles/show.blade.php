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
                    src="{{ $user->avatar }}"
                    alt="{{ $user->name }}"
                />
            </div>

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                    <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>

                    @if (auth()->user()->is($user))
                        <p class="text-sm mt-2 text-blue-800">
                            <span class="font-bold mr-2">{{ $user->username }}<br />{{ $user->email }}</span>
                        </p>
                    @endif

                    <p class="text-sm mt-2 italic text-blue-800">
                        <a href=""><span class="hover:underline font-bold mr-2">{{ $user->countFollows() }} Following</span></a>
                        <a href=""><span class="hover:underline font-bold">{{ $user->countFollowers() }} Followers</span></a>
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
            'tweets' => $user->tweets
        ])
    </div>
</x-app>
