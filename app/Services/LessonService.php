<?php

namespace App\Services;

use App\Lesson;

class LessonService
{
    public function getNext(Lesson $lesson)
    {
        $id = $lesson->id;
        $course_id = $lesson->section->course_id;

        $next = Lesson::select(['id', 'section_id', 'name'])->where('id', '>', $id)
            ->whereIn('section_id', function ($query) use ($course_id) {
                $query->select('id')->from('sections')->where('course_id', $course_id);
            })
            ->orderBy('id', 'asc')
            ->first();
        return $next;
    }

    public function getNextUrl(Lesson $lesson) : string
    {
        if ($lesson->questions_count > 0) {
            $nextUrl = route('lessons.questions', ['id' => $lesson->id]);
        } else {
            $nextLesson = $this->getNext($lesson);
            $nextUrl = route('lessons.show', ['id' => $nextLesson->id]);
        }

        return $nextUrl;
    }

    public function getPrevious(Lesson $lesson)
    {
        $id = $lesson->id;
        $course_id = $lesson->section->course_id;

        $previous = Lesson::where('id', '<', $id)
            ->whereIn('section_id', function ($query) use ($course_id) {
                $query->select('id')->from('sections')->where('course_id', $course_id);
            })
            ->orderBy('id', 'desc')
            ->first();
        return $previous;
    }
}