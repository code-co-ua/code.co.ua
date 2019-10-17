<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
        $courses = Auth::user()->courses()
            ->select('*')
            ->withCompletedLessonsCount()
            ->withLessonsCount()
            ->withLastCompletedLessonId()
            ->get();

        return view('home', ['courses' => $courses]);
    }
}
