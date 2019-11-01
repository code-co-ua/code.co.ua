<?php

namespace Domain\Course;

use Domain\Lesson\Lesson;
use Illuminate\Database\Eloquent\Model;

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
