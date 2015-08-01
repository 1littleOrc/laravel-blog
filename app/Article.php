<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Article extends Model
{
    protected $fillable = ['title', 'path', 'content', 'small'];


    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'article_id');
    }

    public function getImageUrl()
    {
        if (preg_match('/< *img[^>]*src\s*=\s*["\']?([^"\']*)/i', $this->content, $matches)) {
            $url = $matches[1];
            if (starts_with($url, '/') && !starts_with($url, '//'))
                $url = URL::to($url);
        } else
            $url = URL::to('/images/logo.png');
        return $url;
    }

    public function getDate()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }

    public static function byTag($tag)
    {
        return self::where('content', 'like', "%$tag%")
            ->orWhere('title', 'like', "%$tag %")
            ->orderBy('id', 'desc');
    }

    public function getURL()
    {
        if ($this->path)
            return route('post', $this->path);
        return route('post_by_id', $this->id);
    }
}
