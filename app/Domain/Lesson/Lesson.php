<?php

declare(strict_types=1);

namespace Domain\Lesson;

use Domain\Course\Section;
use Domain\Exercise\Exercise;
use Domain\Question\Question;
use Laravelista\Comments\Commentable;
use OwenIt\Auditing\{Auditable, Contracts\Auditable as AuditableContract};
use Illuminate\Database\Eloquent\{Builder, Model, Relations\BelongsTo, Relations\HasMany, Relations\HasOne};

class Lesson extends Model implements AuditableContract
{
    use Commentable, Auditable;

    /** @var array */
    protected $fillable = [
        'id',
        'section_id',
        'name',
        'video',
        'body',
    ];

    /** @var array */
    protected $auditInclude = [
        'name',
        'video',
        'body',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function exercise(): HasOne
    {
        return $this->hasOne(Exercise::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function scopeWhereCourse(Builder $builder, int $courseId): Builder
    {
        return $builder->whereIn('section_id', function ($query) use ($courseId) {
            $query->select('id')->from('sections')->where('course_id', $courseId);
        });
    }

    public function next(): ?Lesson
    {
        return Lesson::whereId('>', $this->id)->whereCourse($this->section->course_id)->orderBy('id', 'asc')->first();
    }

    public function previous(): ?Lesson
    {
        return Lesson::whereId('<', $this->id)->whereCourse($this->section->course_id)->orderBy('id', 'desc')->first();
    }
}
