<?php

namespace App\Listeners;

use App\Notifications\LessonCommented;
use App\Section;
use App\User;
use Laravelista\Comments\Events\CommentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentedNotification
{
    /**
     * Handle the event.
     *
     * @param  CommentCreated $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        if ($event->comment->commentable_type == "lesson"){
            $section = Section::select('id', 'user_id')->find($event->comment->commentable->section_id);
            $user = User::find($section->user_id);
            $user->notify(new LessonCommented($event->comment->commentable, $event->comment->commenter));
        }
    }
}
