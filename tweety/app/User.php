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

    public function getAvatarAttribute($avatar)
    {
        return !empty($avatar)
            ? asset('storage/'.$avatar)
            : "https://i.pravatar.cc/200?u={$this->email}";
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function timeline()
    {
        $ids = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $ids)
            ->orWhere('user_id', $this->id)
            ->latest()
            ->get();

        // $ids->push($this->id);
        // return Tweet::whereIn('user_id', $ids)->latest()->get();
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function user_profile()
    {
        return (Route::currentRouteName() == "tweety.user_profile")
            ? auth()->user()
            : auth()->user();
    }
}
