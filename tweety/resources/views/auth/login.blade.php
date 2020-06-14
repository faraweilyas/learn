<x-master>
    <div class="container mx-auto flex justify-center mb-6">
        <div class="w-full max-w-xs">
            <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
                @csrf

                <div class="block text-gray-700 text-sm font-bold mb-4 flex justify-center">{{ __('Login') }}</div>

                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="email"
                    >
                        E-Mail Address:
                    </label>
                    <input
                        class="shadow appearance-none border @error('email') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="email"
                        id="email"
                        type="email"
                        placeholder="E-Mail Address:"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                    />
                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="password"
                    >
                        Password:
                    </label>
                    <input
                        class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="password"
                        id="password"
                        type="password"
                        placeholder="******************"
                        required
                        autocomplete="current-password"
                    />
                    @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <div>
                        <input
                            class="mr-1"
                            type="checkbox"
                            name="remember"
                            id="remember" {{ old('remember') ? 'checked' : '' }}
                        />

                        <label
                            class="text-xs text-gray-700 font-bold uppercase"
                            for="remember"
                        >
                            Remember Me
                        </label>
                        @error('remember')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Login
                    </button>
                    <a
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        href="{{ route('password.request') }}"
                    >
                        Forgot Your Password?
                    </a>
                </div>
            </form>
            <p class="text-center text-gray-500 text-xs">
                &copy;{{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>
</x-master>
