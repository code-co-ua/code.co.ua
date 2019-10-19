<?php

namespace Domain\Exercise;

use Domain\Lesson\Lesson;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'title',
        'body',
        'solution',
        'output',
        'language',
        'lesson_id',
        'user_id',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($table)
        {
            $table->user_id = auth()->id();
        });
    }
}
