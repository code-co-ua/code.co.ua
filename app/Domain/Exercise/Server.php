<?php

namespace Domain\Exercise;

//use Domain\Exercise\Enums\ServerStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

final class Server extends Model
{
    use HasStatuses;

    protected $fillable = [
        'host',
        'user',
    ];

//    protected $casts = [
//        'status' => ServerStatusEnum::class,
//    ];
}
