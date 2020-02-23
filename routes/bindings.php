<?php

use Domain\Lesson\Lesson;
use Illuminate\Support\Facades\Route;

Route::patterns(['course' => '[0-9]+', 'id' => '[0-9]+']);

Route::bind('lesson', function (string $value, $route) {
    return Lesson::whereCourse($route->parameter('course'))
        ->with('section')
        ->withCount('exercise', 'questions')
        ->findOrFail($value);
});
