<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    protected $fillable = [
        'username', 'avatar', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarPathAttribute()
    {
        return !empty($this->avatar)
            ? pc_asset('storage/'.$this->avatar)
            : "https://i.pravatar.cc/200?u={$this->email}";
    }

    public function getUsername()
    {
        return "@{$this->username}";
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function isVerified() : bool
    {
        return (in_array($this->id, [1,3]));
    }

    public function timeline()
    {
        $ids = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $ids)
            ->orWhere('user_id', $this->id)
            ->withLikes()
            ->latest()
            ->paginate(10);

        // $ids->push($this->id);
        // return Tweet::whereIn('user_id', $ids)->latest()->paginate(10);
        // return Tweet::whereIn('user_id', $ids)->latest()->get();
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
