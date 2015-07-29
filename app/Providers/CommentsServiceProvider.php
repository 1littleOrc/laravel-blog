<?php

namespace App\Providers;

use App\Comment;
use Illuminate\Support\ServiceProvider;

class CommentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Comment::created(function ($comment) {
            $article = $comment->article();
            $article->comments += 1;
            $article->save();
        });

        Comment::deleting(function ($comment) {
            $article = $comment->article();
            $article->comments -= 1;
            $article->save();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
