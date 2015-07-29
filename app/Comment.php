<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['username', 'body'];

    /**
     * Comment belongs to an article.
     *
     * @return User
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }


}
