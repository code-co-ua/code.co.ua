<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->get();

        return view('courses.index', [
            'courses' => $courses,
            'fake_courses' => app('CourseFakeData')->generate(18 - $courses->count())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id integer
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $course = Course
            ::select('*')
            ->withLessonsCount()
            ->when(Auth::check(), function ($query) {
                $query->withLastCompletedLessonId();
            })
            ->with('sections.lessons')
            ->withExercisesCount()
            ->withQuestionsCount()
            ->findOrFail($id);

        return view('courses.show', ['course' => $course]);
    }

    public function complete(int $id)
    {
        $course = Auth::user()->courses()
            ->withCompletedLessonsCount()
            ->withLessonsCount()
            ->findOrFail($id);

        return view('courses.completed', ['course' => $course]);
    }
}
