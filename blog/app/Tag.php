<?php

namespace App;

use App\Article;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function pathToarticlesWithTag()
    {
        return route('articles.index', ['tag' => $this->name]);
    }
}
