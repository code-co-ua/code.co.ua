<?php

namespace Domain\Comment\Listeners;

use Domain\Comment\Notifications\CommentReply;
use App\User;
use Laravelista\Comments\Events\CommentCreated;

class SendCommentedReplyNotification
{
    public function handle(CommentCreated $event)
    {
        if ($event->comment->child_id) {
            $user = User::find($event->comment->parent->commenter_id);
            $user->notify(new CommentReply($event->comment));
        }
    }
}
