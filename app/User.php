<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JD\Cloudder\Facades\Cloudder;
use Laravelista\Comments\Commenter;

class User extends Authenticatable
{
    use Notifiable, Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'balance',
        'about',
        'isAdmin',
        'isEditor',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function medias()
    {
        return $this->hasMany('App\Media');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_user');
    }

    public function lessons()
    {
        return $this->belongsToMany('App\Lesson', 'lesson_user');
    }

    public function attachCourse(int $id)
    {
        auth()->user()->courses()->syncWithoutDetaching($id);
    }

    public function attachLesson(int $id)
    {
        if (!auth()->user()->lessons->contains($id)) {
            auth()->user()->lessons()->attach($id);
            auth()->user()->increment('balance');
        }
    }

    public function getAvatarUrlAttribute(){
        return Cloudder::show($this->avatar, ['width' => 150, 'height' => 150]);
    }
}
