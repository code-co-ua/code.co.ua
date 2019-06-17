<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['title', 'course_id', 'user_id'];

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
