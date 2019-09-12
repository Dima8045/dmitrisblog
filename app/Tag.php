<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'id', 'tag_id');
    }
}
