<?php

declare(strict_types=1);

namespace Domain\User;

use Domain\Article\Article;
use Domain\Course\Course;
use Domain\Lesson\Lesson;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JD\Cloudder\Facades\Cloudder;
use Laravelista\Comments\Commenter;

final class User extends Authenticatable
{
    use Notifiable, Commenter;

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

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
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
        return $this;
    }

    public function attachLesson(int $id)
    {
        if (!auth()->user()->lessons->contains($id)) {
            auth()->user()->lessons()->attach($id);
            auth()->user()->increment('balance');
        }
        return $this;
    }

    /**
     * TODO - fix package compatibility with PHP 7.4
     */
    public function getAvatarUrlAttribute(): string
    {
        return '';
//        return Cloudder::show($this->avatar, ['width' => 150, 'height' => 150]);
    }
}
