<?php

namespace App;

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
        $this->belongsTo(User::class);
    }
}
