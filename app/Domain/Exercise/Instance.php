<?php

namespace Domain\Exercise;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $exercise_id
 * @property int $server_id
 * @property int $user_id
 * @property int $container_id
 * @property string $url
 * @property boolean $is_completed
 * Custom attributes
 * @property string $status_key
 */
final class Instance extends Model
{
    protected $fillable = [
        'exercise_id',
        'server_id',
        'user_id',
        'container_id',
        'url',
        'is_completed',
    ];

    public function getStatusKeyAttribute(): string
    {
        return "instance:{$this->id}";
    }
}
