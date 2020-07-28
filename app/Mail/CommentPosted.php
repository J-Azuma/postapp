<?php

namespace App\Mail;

use App\Comment;
use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $comment;
    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Comment $comment, Post $post)
    {
        $this->user = $user;
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('comment posted to your post')
                    ->view('emails.comments.posted');
    }
}
