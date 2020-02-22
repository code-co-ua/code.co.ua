<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Course\Course;
use Domain\Exercise\ExerciseService;
use Domain\Lesson\Lesson;
use Illuminate\Http\Request;

final class ExerciseController extends Controller
{
    private ExerciseService $service;

    public function __construct(ExerciseService $exerciseService)
    {
        $this->service = $exerciseService;
    }

    public function show(Course $course, Lesson $lesson, Request $request)
    {
        $this->service->launchInstance($lesson->exercise, $request->session()->getId());

        return view('lessons.exercise', [
            'exercise' => $lesson->exercise
        ]);
    }
}
