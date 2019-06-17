<?php

use SleepingOwl\Admin\Navigation\Page;

AdminNavigation::setAccessLogic(function (Page $page) {
    return auth()->user()->isAdmin;
});

return [
    [
        'title' => 'Панель',
        'icon' => 'fa fa-dashboard',
        'url' => route('admin.dashboard'),
    ],

    (new Page(\App\User::class))
        ->setIcon('fa fa-users'),

    [
        'title' => 'Курси',
        'icon' => 'fa fa-graduation-cap',
        'pages' => [
            (new Page(\App\Course::class))
                ->setIcon('fa fa-graduation-cap'),

            (new Page(\App\Section::class))
                ->setIcon('fa fa-bars'),
        ]
    ],

    [
        'title' => 'Уроки',
        'icon' => 'fa fa-book',
        'pages' => [
            (new Page(\App\Lesson::class))
                ->setIcon('fa fa-book'),

            (new Page(\App\Exercise::class))
                ->setIcon('fa fa-briefcase'),

            (new Page(\App\Question::class))
                ->setIcon('fa fa-question-circle'),

            (new Page(\App\Answer::class))
                ->setIcon('fa fa-question'),
        ]
    ],

    (new Page(\App\Article::class))
        ->setIcon('fa fa-archive'),

    (new Page(\App\Category::class))
        ->setIcon('fa fa-columns'),

    (new Page(\Laravelista\Comments\Comment::class))
        ->setIcon('fa fa-comment')
];
