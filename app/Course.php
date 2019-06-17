<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravelista\Comments\Commentable;

class Course extends Model
{
    use Commentable;

    protected $fillable = [
        'id',
        'title',
        'name',
        'description',
        'description_short',
        'description_after',
        'image',
        'user_id'
    ];

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function scopeWithQuestionsCount($query)
    {
        $query->selectSub(function ($query) {
            $query->from('questions')
                ->selectRaw('COUNT(id)')
                ->whereIn('lesson_id', function ($query) {
                    $this->getLessonsId($query);
                });
        }, 'questions_count');
    }

    public function scopeWithExercisesCount($query)
    {
        $query->selectSub(function ($query) {
            $query->from('exercises')
                ->selectRaw('COUNT(id)')
                ->whereIn('lesson_id', function ($query) {
                    $this->getLessonsId($query);
                });
        }, 'exercises_count');
    }

    public function scopeWithLessonsCount($query)
    {
        $count = Lesson::selectRaw('COUNT(id)')->whereIn('section_id', function ($query) {
            $query->select('id')->from('sections')->whereRaw('"sections"."course_id" = "courses"."id"');
        });
        return $query->selectSub($count, 'lessons_count');
    }

    public function scopeWithCompletedLessonsCount($query)
    {
        $count = DB::table('lesson_user')
                ->selectRaw('COUNT(lesson_id)')
                ->whereIn('lesson_id', function ($query) {
                    $this->getLessonsId($query);
                });
        $query->selectSub($count, 'completed_lessons_count');
    }

    public function scopeWithLastCompletedLessonId($query)
    {
        $id = DB::table('lesson_user')
                ->select('lesson_id')
                ->whereIn('lesson_id', function ($query) {
                    $this->getLessonsId($query);
                })
                ->orderBy('lesson_id', 'desc')
                ->limit(1);
        return $query->selectSub($id, 'last_completed_lesson_id');
    }

    public function getLessonsId($query)
    {
        return $query->select('id')
            ->from('lessons')
            ->whereIn('section_id', function ($query) {
                $query
                    ->select('id')
                    ->from('sections')
                    ->whereRaw('"sections"."course_id" = "courses"."id"');
            });
    }
}
