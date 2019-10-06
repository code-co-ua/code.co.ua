<?php

namespace App\Http\Controllers;

use App\Course;
use App\FakeData\CourseFakeData;
use App\FakeData\FakeData;
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
    public function show($id)
    {
        $course = Course
            ::select('*')
            ->withLessonsCount()
            ->when(Auth::check(), function ($query) {
                $query->withLastCompletedLessonId()
                      ->withCompletedLessonsCount();
            })
            ->with('sections.lessons')
            ->withExercisesCount()
            ->withQuestionsCount()
            ->findOrFail($id);

        return view('courses.show', ['course' => $course]);
    }

    public function complete($id)
    {
        $course = auth()->user()->courses()
            ->withCompletedLessonsCount()
            ->withLessonsCount()
            ->findOrFail($id);

        return view('courses.completed', ['course' => $course]);
    }
}
