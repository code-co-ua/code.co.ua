<?php

namespace Domain\Exercise;

use Illuminate\Database\Eloquent\Model;

final class Instance extends Model
{
    protected $fillable = [
        'exercise_id',
        'server_id',
        'user_id',
        'is_completed',
    ];
}
