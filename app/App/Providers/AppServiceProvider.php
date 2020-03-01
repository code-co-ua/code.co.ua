<?php

namespace App\Providers;

use Domain\Article\Article;
use Domain\Course\Course;
use Domain\Lesson\Lesson;
use Domain\User\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;
use Laravelista\Comments\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Relation::morphMap([
            'articles' => Article::class,
            'lessons' => Lesson::class,
            'courses' => Course::class,
            'comments' => Comment::class,
            'user' => User::class,
        ]);
        //for notifications - see https://github.com/laravel/ideas/issues/366
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerMacros();
    }

    private function registerMacros(): void
    {
        /**
         * Get the portion of a string before a given value.
         *
         * @param  string  $subject
         * @param  string  $before
         * @param  string  $after
         * @return string
         */
        Str::macro('between', function (string $subject, string $before, string $after) {
            if ($before === '' || $after === '') {
                return $subject;
            }

            $rightCropped = Str::after($subject, $before);

            return Str::before($rightCropped, $after);
        });
    }
}
