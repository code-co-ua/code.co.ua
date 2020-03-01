<?php

namespace Domain\Course;

use Domain\Lesson\Lesson;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Course $course
 * @property string $title
 * @property int $course_id
 * @property int $user_id
 */
class Section extends Model
{
    protected $fillable = [
        'title',
        'course_id',
        'user_id'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
