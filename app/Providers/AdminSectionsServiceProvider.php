<?php

namespace App\Providers;

use Illuminate\Notifications\Notification;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        \App\Course::class => 'App\Admin\Http\Sections\Courses',
        \App\Section::class => 'App\Admin\Http\Sections\Sections',
        \App\Lesson::class => 'App\Admin\Http\Sections\Lessons',
        \App\Exercise::class => 'App\Admin\Http\Sections\Exercises',
        \App\Question::class => 'App\Admin\Http\Sections\Questions',
        \App\Answer::class => 'App\Admin\Http\Sections\Answers',
        \App\User::class => 'App\Admin\Http\Sections\Users',
        \App\Article::class => 'App\Admin\Http\Sections\Articles',
        \App\Category::class => 'App\Admin\Http\Sections\Categories',
        \Laravelista\Comments\Comment::class => 'App\Admin\Http\Sections\Comments',
    ];

    /**
     * Register sections.
     *
     * @param \SleepingOwl\Admin\Admin $admin
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
