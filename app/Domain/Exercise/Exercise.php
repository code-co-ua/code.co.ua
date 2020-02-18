<?php

namespace Domain\Exercise;

use Domain\Lesson\Lesson;
use Domain\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Lesson $lesson
 * @property User $user
 */
final class Exercise extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'language_id',
        'lesson_id',
        'user_id',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
