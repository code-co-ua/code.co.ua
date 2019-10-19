<?php

namespace Domain\Article;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;
use Conner\Tagging\Taggable;

class Article extends Model
{
    use Commentable, Taggable;

    protected $fillable = [
        'name',
        'body',
        'image',
        'status',
        'user_id',
        'category_id'
    ];

    public const status = [
        'in_confirmation' => 'На модерації',
        'in_editing' => 'На редагуванні',
        'not_confirmed' => 'Не затверджено',
        'confirmed' => 'Затверджено'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function getStatusTextAttribute()
    {
        return self::status[$this->status];
    }
}
