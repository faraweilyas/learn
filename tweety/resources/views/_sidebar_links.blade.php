<ul>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="{{ route('tweety.home') }}">Home</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="{{ route('tweety.user_profile', auth()->user()) }}">Pofile</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="{{ route('tweety.explore') }}">Explore</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="#">Notifications</a>
    </li>
    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" type="submit">Logout</button>
        </form>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="{{ route('register') }}">Register</a>
    </li>
</ul>
