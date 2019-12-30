<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Course\Course;
use Domain\Exercise\Actions\LaunchInstance;
use Domain\Lesson\Lesson;

final class ExerciseController extends Controller
{
    public function show(Course $course, Lesson $lesson, LaunchInstance $launchInstance)
    {
        $launchInstance->onQueue('default')->execute($lesson->exercise);

        return view('lessons.exercise', [
            'exercise' => $lesson->exercise
        ]);
    }
}
