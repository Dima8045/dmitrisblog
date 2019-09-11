<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'image', 'category_id', 'user_id'];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
