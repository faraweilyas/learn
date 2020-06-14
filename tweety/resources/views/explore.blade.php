<x-app>
    <div>
        @foreach($users as $user)

            <div class="flex items-center mb-5">
                    <img
                        style='width: 40px;'
                        class="rounded-full mr-2 mb-3"
                        src="{{ $user->avatar }}"
                        alt="{{ $user->name }}"
                    />

                <a class="hover:underline hover:text-blue-500" href="{{ route('tweety.user_profile', $user) }}">
                    <div>
                        <h4 class="font-bold">{{ $user->name }}</h4>
                        <p>{{ '@'.$user->username }}</p>
                    </div>
                </a>
            </div>

        @endforeach

        {{ $users->links() }}
    </div>
</x-app>
