<?php

namespace Domain\Exercise;

use Domain\Lesson\Lesson;
use Domain\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Relations
 * @property Lesson $lesson
 * @property User $user
 * Fields
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property int $language_id
 * @property int $lesson_id
 * @property int $user_id
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
