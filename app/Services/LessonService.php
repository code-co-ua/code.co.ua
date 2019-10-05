<?php

namespace App\Services;

use App\Lesson;

class LessonService
{
    public function getNext(Lesson $lesson)
    {
        $course_id = $lesson->section->course_id;

        return Lesson::select(['id', 'section_id', 'name'])->where('id', '>', $lesson->id)
            ->whereIn('section_id', function ($query) use ($course_id) {
                $query->select('id')->from('sections')->where('course_id', $course_id);
            })
            ->orderBy('id', 'asc')
            ->first();
    }

    public function getNextUrl(Lesson $lesson) : string
    {
        if ($lesson->questions_count > 0) {
            return route('lessons.questions', ['id' => $lesson->id]);
        }

        $nextLesson = $this->getNext($lesson);
        return route('lessons.show', ['id' => $nextLesson->id]);
    }

    public function getPrevious(Lesson $lesson)
    {
        $course_id = $lesson->section->course_id;

        return Lesson::where('id', '<', $lesson->id)
            ->whereIn('section_id', function ($query) use ($course_id) {
                $query->select('id')->from('sections')->where('course_id', $course_id);
            })
            ->orderBy('id', 'desc')
            ->first();
    }
}