<?php

namespace App\Listeners;

use App\Notifications\CommentReply;
use App\User;
use Laravelista\Comments\Comment;
use Laravelista\Comments\Events\CommentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentedReplyNotification
{
    /**
     * Handle the event.
     *
     * @param  CommentCreated $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        if ($event->comment->child_id) {
            $user = User::find($event->comment->parent->commenter_id);
            $user->notify(new CommentReply($event->comment));
        }
    }
}
