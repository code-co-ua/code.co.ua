<?php

declare(strict_types=1);

namespace Domain\Exercise;

use Illuminate\Database\Eloquent\{Model, Relations\HasMany};

final class Language extends Model
{
    protected $fillable = [
        'folder',
        'slug',
        'title',
    ];

    protected $table = 'exercise_languages';

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}