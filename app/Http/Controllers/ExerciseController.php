<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exercise;
use App\Services\GlotService;
use App\Services\LessonService;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * @var GlotService
     */
    private $glotService;

    /**
     * @var LessonService
     */
    private $lessonService;

    /**
     * ExerciseController constructor.
     * @param GlotService $glotService
     * @param LessonService $lessonService
     */
    public function __construct(GlotService $glotService, LessonService $lessonService)
    {
        $this->glotService = $glotService;
        $this->lessonService = $lessonService;
    }

    /**
     * Display exercise the specified lesson.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $exercise = Exercise::with([
            'user:id,name',
            'lesson' => function ($query) {
                $query->select(['id', 'section_id'])
                    ->withCount('questions')
                    ->with('section:id,course_id');
            }
        ])->where('lesson_id', $id)->firstOrFail();

        $nextUrl = $this->lessonService->getNextUrl($exercise->lesson);

        $prevUrl = route('lessons.show', $exercise->lesson->id);

        return view('lessons.exercise', [
            'exercise' => $exercise,
            'next_url' => $nextUrl,
            'prev_url' => $prevUrl
        ]);
    }

    /**
     * Find exercise, exec code with glot api and check output
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request)
    {
        $exercise = Exercise::select('id', 'output', 'language')->findOrFail($request->id);

        $response = $this->glotService->run($exercise->language, $request->code);

        return response()->json([
            'is_passed' => $exercise->output == $response->stdout,
            'response' => $response
        ]);
    }
}
