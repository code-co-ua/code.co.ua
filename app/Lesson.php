<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Lesson extends Model implements AuditableContract
{
    use Commentable, Auditable;

    protected $fillable = ['id', 'section_id', 'name', 'video', 'body'];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'name',
        'video',
        'body',
    ];

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function exercises()
    {
        return $this->hasMany('App\Exercise');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
