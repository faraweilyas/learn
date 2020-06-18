<?php

namespace App;

trait Followable
{
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id');
    }

    public function countFollowers()
    {
        return formatAmount($this->followers()->count(), TRUE, NULL);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    public function countFollows()
    {
        return formatAmount($this->follows()->count(), TRUE, NULL);
    }

    public function follow(User $user)
    {
        return $this->follows()->sync($user, false);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        return $this->follows()->toggle($user);

        // if ($this->isFollowing($user)) {
        //     return $this->unfollow($user);
        // }

        // return $this->follow($user);
    }

    public function isFollowing(User $user)
    {
        $ids = $this->follows()->pluck('id');

        return $ids->contains($user->id) ? true : false;
    }

    public function following(User $user)
    {
        return $this
            ->follows()
            ->where('following_user_id', $user->id)
            ->exists();
    }

    public function friends()
    {
        $followsIds     = $this->follows()->pluck('id');
        $followersIds   = $this->followers()->pluck('id');
        $friendsIds     = $followsIds->merge($followersIds)->unique()->all();
        $friends        = User::whereIn('id', $friendsIds)
                            ->latest()
                            ->get();

        // dd($followsIds, $followersIds, $friendsIds, $friends);
        return $friends;
    }
}
