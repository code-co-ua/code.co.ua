<?php

namespace Domain\User;

use Domain\Article\Article;
use Domain\Course\Course;
use Domain\Lesson\Lesson;
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
        return $this->hasMany(Article::class);
    }

    public function medias()
    {
        return $this->hasMany('App\Media');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user');
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
