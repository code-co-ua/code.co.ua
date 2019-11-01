<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Course\Course;
use Domain\Lesson\Lesson;
use Illuminate\Support\Facades\Auth;

final class LessonController extends Controller
{
    public function show(Course $course, Lesson $lesson)
    {
        if (Auth::check()) {
            Auth::user()->attachLesson($lesson->id)->attachCourse($course->id);
        }

        return view('lessons.show', [
            'lesson' => $lesson,
            'previous' => $lesson->previous(),
            'next' => $lesson->next(),
            'course' => $course,
        ]);
    }
}
