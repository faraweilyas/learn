<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view("profiles.show", compact('user'));
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
        // dd(request('avatar'));

        $validated = request()->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user), 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['required', 'file'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['avatar'] = request('avatar')->store('avatars');

        $user->update($validated);

        return redirect()->route('tweety.user_profile', $user);
    }
}
