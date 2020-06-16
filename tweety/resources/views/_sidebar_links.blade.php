<ul>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="{{ route('tweety.home') }}">Home</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="{{ route('tweety.user_profile', auth()->user()) }}">Pofile</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="/explore">Explore</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="#">Notifications</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="#">Messages</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="#">Bookmarks</a>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="#">Lists</a>
    </li>
    <li>
        <a
            class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block"
            href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    <li>
        <a class="font-bold hover:underline hover:text-blue-500 text-lg mb-4 block" href="{{ route('register') }}">Register</a>
    </li>
</ul>
