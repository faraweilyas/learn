<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Likeable
{
    public function getLikesAttribute($likes)
    {
        return is_null($likes) ? 0 : $likes;
    }

    public function getDislikesAttribute($dislikes)
    {
        return is_null($dislikes) ? 0 : $dislikes;
    }

    public function scopeWithlikes(Builder $query)
    {
        $query->leftJoinSub(
            'SELECT `tweet_id`, sum(liked) likes, sum(!liked) dislikes FROM `likes` GROUP BY `tweet_id`',
            'likes',
            'likes.tweet_id',
            'tweets.id',
        );
    }

    public function like($user=null, bool $liked=true)
    {
        return $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id()
        ], [
            'liked' => $liked
        ]);
    }

    public function dislike($user=null)
    {
        return $this->like($user, false);
    }

    public function isLikedBy(User $user, bool $liked=true)
    {
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', $liked)->count();
        // N+1 issue
        // return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $this->isLikedBy($user, false);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
