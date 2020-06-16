<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form action="/tweets" method="POST">
        @csrf
        <textarea
            name="body"
            class="w-full"
            placeholder="What's up doc?"
            required
        >
            {{ old('body') }}
        </textarea>

        <hr class="my-4" />

        <footer class="flex justify-between">
            <a href="{{ route('tweety.user_profile', auth()->user()) }}">
                <img
                    src="{{ auth()->user()->avatar }}"
                    alt="{{ auth()->user()->name }}"
                    class="rounded-full mr-2"
                    width='50'
                    height='50'
                />
            </a>

            <button
                type="submit"
                class="bg-blue-400 hover:bg-blue-600 rounded-lg shadow px-10 text-sm text-white h-10 inline-flex items-center"
            >
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                </svg> Publish
            </button>
        </footer>
    </form>
    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
