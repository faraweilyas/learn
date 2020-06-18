<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view("profiles.show", [
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->latest()->paginate(10),
        ]);
    }

    public function edit(User $user)
    {
        // $this->authorize('edit', $user);

        // if (auth()->user()->isNot($user)) {
        //     abort(404);
        // }
        // or
        // abort_if(auth()->user()->isNot($user), 404);

        return view("profiles.edit", compact('user'));
    }

    public function update(User $user)
    {
        $validated = request()->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user), 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['file'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (request('avatar')) {
            $validated['avatar'] = request('avatar')->store('avatars');
            Storage::delete($user->avatar);
        }

        $user->update($validated);

        return redirect()->route('tweety.user_profile', $user);
    }
}
