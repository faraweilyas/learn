<x-app>
    <form action="{{ route('tweety.user_update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-6">
            <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">Username:</label>

            <input id="username" type="text" class="border border-gray-400 p-2 w-full @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autofocus>

            @error('username')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="avatar" class="block mb-2 uppercase font-bold text-xs text-gray-700">Avatar:</label>

            <div class="flex">
                <input id="avatar" type="file" class="border border-gray-400 p-2 w-full @error('avatar') is-invalid @enderror" name="avatar" />

                <img
                    src="{{ $user->avatar }}"
                    alt="{{ $user->username }}"
                    width='40'
                    height='40'
                />
            </div>

            @error('avatar')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">Name:</label>

            <input id="name" type="text" class="border border-gray-400 p-2 w-full @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required />

            @error('name')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email:</label>

            <input id="email" type="email" class="border border-gray-400 p-2 w-full @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" />

            @error('email')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password:</label>

            <input id="password" type="password" class="border border-gray-400 p-2 w-full @error('password') is-invalid @enderror" name="password" required />

            @error('password')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 uppercase font-bold text-xs text-gray-700">Confirm Password:</label>

            <input id="password_confirmation" type="password" class="border border-gray-400 p-2 w-full @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required />

            @error('password')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="px-6 py-4 rounded text-sm uppercase bg-blue-400 text-white">
                    Update Profile
                </button>
            </div>
        </div>

    </form>
</x-app>
