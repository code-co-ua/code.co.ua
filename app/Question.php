<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body', 'answer_id', 'lesson_id'];

    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }

    public function answers()
    {
        return $this->belongsToMany('App\Answer', 'question_answer');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }
}
