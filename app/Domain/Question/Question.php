<?php

namespace Domain\Question;

use Domain\Lesson\Lesson;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body', 'answer_id', 'lesson_id'];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'question_answer');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
