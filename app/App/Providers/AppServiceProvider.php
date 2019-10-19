<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Relation::morphMap([
            'articles' => 'App\Article',
            'lessons' => 'App\Lesson',
            'courses' => 'App\Course',
            'comments' => 'Laravelista\Comments\Comment',
            'user' => 'App\User',
        ]);
        //for notifications - see https://github.com/laravel/ideas/issues/366
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
