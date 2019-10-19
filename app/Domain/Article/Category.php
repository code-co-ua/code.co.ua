<?php

namespace Domain\Article;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'color'];

    public $timestamps = false;
}
