<?php

namespace Domain\User;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['name', 'user_id'];
}
