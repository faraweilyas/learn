<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form action="/tweets" method="POST">
        @csrf
        <textarea
            name="body"
            class="w-full"
            placeholder="What's up doc?"
            required
        >{{ old('body') }}</textarea>

        <hr class="my-4" />

        <footer class="flex justify-between">
            <a href="{{ route('tweety.user_profile', auth()->user()) }}">
                <img
                    src="{{ auth()->user()->avatar }}"
                    alt="{{ auth()->user()->name }}"
                    class="rounded-full mr-2"
                    width='40'
                    height='40'
                />
            </a>

            <button
                type="submit"
                class="bg-blue-400 rounded-lg shadow py-2 px-2 text-white"
            >
                Publish
            </button>
        </footer>
    </form>
    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
