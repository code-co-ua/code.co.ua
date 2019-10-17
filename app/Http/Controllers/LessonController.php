<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Lesson;
use App\Services\LessonService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var LessonService
     */
    private $lessonService;

    /**
     * LessonController constructor.
     * @param UserService $userService
     * @param LessonService $lessonService
     */
    public function __construct(UserService $userService, LessonService $lessonService)
    {
        $this->userService = $userService;
        $this->lessonService = $lessonService;
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $lesson = Lesson::with('section')
            ->withCount('exercises', 'questions')
            ->findOrFail($id);
        $completedLessons = $this->userService->getCompletedLessons();

        if (Auth::check()) {
            Auth::user()->attachLesson($id);
            Auth::user()->attachCourse($lesson->section->course_id);
        }

        $previous = $this->lessonService->getPrevious($lesson);
        $next = $this->lessonService->getNext($lesson);

        return view('lessons.show', [
            'lesson' => $lesson,
            'previous' => $previous,
            'next' => $next,
            'completed_lessons' => $completedLessons
        ]);
    }

    /**
     * Display the specified resource with questions relation.
     * @todo Refactor
     * @param $lesson_id integer
     * @return \Illuminate\Http\Response
     */
    public function questions($lesson_id)
    {
        $lesson = Lesson::with('questions.answers')
            ->withCount('questions')
            ->findOrFail($lesson_id);
dd($lesson);
        $next = $this->lessonService->getNext($lesson);

        return view('lessons.questions', [
            'lesson' => $lesson,
            'next' => $next
        ]);
    }
}
