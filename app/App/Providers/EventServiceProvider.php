<?php

namespace App\Providers;

use Domain\Comment\Listeners\{SendCommentedNotification, SendCommentedReplyNotification};
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravelista\Comments\Events\CommentCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentCreated::class => [
            SendCommentedNotification::class,
            SendCommentedReplyNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
