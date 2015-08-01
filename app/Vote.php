<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;
    protected $fillable = ['value', 'rid'];

    /**
     * Vote belongs to an article.
     *
     * @return User
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
