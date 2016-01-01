<?php

namespace App;
use Mail;
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
        return $this->belongsTo(Article::class, 'post_id');
    }


    /**
     * Send email notification about new comment
     */
    public function notify_admin(Article $article)
    {
        $view_data = [
            'article_url' => $article->getURL(),
            'article_name' => $article->title,
            'username' => $this->username,
            'text' => $this->body
        ];
        Mail::send('emails.new-comment', $view_data, function ($message) {
            $email = config('mail.from')['address'];
            $message->to($email)
                ->subject('Новый комментарий в блоге (IP ' . $_SERVER['REMOTE_ADDR'] . ')')
                ->from('no-replay@' . $_SERVER['SERVER_NAME'], $_SERVER['SERVER_NAME']);
        });
    }
}
