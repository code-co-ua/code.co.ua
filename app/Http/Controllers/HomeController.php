<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = auth()->user()->courses()
            ->select('*')
            ->withCompletedLessonsCount()
            ->withLessonsCount()
            ->withLastCompletedLessonId()
            ->get();

        return view('home', ['courses' => $courses]);
    }
}
