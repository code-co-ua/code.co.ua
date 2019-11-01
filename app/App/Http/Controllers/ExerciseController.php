<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Course\Course;
use Domain\Lesson\Lesson;

final class ExerciseController extends Controller
{
    public function show(Course $course, Lesson $lesson)
    {
        $lesson->load('exercise.user');

        //TODO - https://github.com/spatie/laravel-view-models
        return view('lessons.exercise', [
            'exercise' => $lesson->exercise,
            'next_url' => route('lessons.show', [
                'course' => $course->id,
                'lesson' => $lesson->next()->id ?? ''
            ]),
            'prev_url' => route('lessons.show', [
                'course' => $course->id,
                'lesson' => $lesson->previous()->id ?? ''
            ]),
        ]);
    }
}
