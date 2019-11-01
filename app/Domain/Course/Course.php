<?php

namespace Domain\Course;

use Domain\Lesson\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Laravelista\Comments\Commentable;

class Course extends Model
{
    use Commentable;

    protected $fillable = [
        'title',
        'name',
        'description',
        'description_short',
        'description_after',
        'image',
        'user_id'
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function isCompleted(): bool
    {
        return $this->lessons_count === $this->completed_lessons_count;
    }

    public function getProgressAttribute(): int
    {
        return (100 / $this->lessons_count) * $this->completed_lessons_count;
    }

    public function getFirstLessonIdAttribute(): ?int
    {
        $section = $this->sections->first();
        return $section ? $section->lessons->pluck('id')->first() : null;
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
            $query->select('id')->from('sections')->whereRaw('sections.course_id = courses.id');
        });
        return $query->selectSub($count, 'lessons_count');
    }

    public function scopeWithCompletedLessonsCount($query)
    {
        return $query->selectSub(
            DB::table('lesson_user')
                ->selectRaw('COUNT(lesson_id)')
                ->whereRaw('`user_id` = `course_user`.`user_id`')
                ->whereIn('lesson_id', function ($query) {
                    $this->getLessonsId($query);
                }),
            'completed_lessons_count'
        );
    }

    public function scopeWithLastCompletedLessonId($query)
    {
        return $query->selectSub(
            DB::table('lesson_user')
                ->select('lesson_id')
                ->whereIn('lesson_id', function ($query) {
                    $this->getLessonsId($query);
                })
                ->orderBy('lesson_id', 'desc')
                ->limit(1),
            'last_completed_lesson_id'
        );
    }

    private function getLessonsId($query)
    {
        return $query->select('id')
            ->from('lessons')
            ->whereIn('section_id', function ($query) {
                $query
                    ->select('id')
                    ->from('sections')
                    ->whereRaw('sections.course_id = courses.id');
            });
    }
}
