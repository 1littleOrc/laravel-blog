<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'path', 'content', 'small'];


    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function getDate()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }
}
