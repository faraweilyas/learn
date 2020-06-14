<form action="{{ route('tweety.user_follow', $user) }}" method="POST">
    @csrf

    <button
        type="submit"
        class="bg-blue-400 rounded-full shadow py-2 px-2 text-white text-xs"
    >
        {{ auth()->user()->following($user) ? 'Unfollow' : 'Follow' }}
    </button>
</form>
