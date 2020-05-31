<?php

namespace App;

use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    // protected $fillable = [];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function path()
    {
        return route('articles.show', $this);
    }

    public function editPath()
    {
        return route('articles.edit', $this);
    }

    public function deletePath()
    {
        return route('articles.edit', $this);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
