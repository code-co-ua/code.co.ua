<?php

declare(strict_types=1);

namespace Domain\Exercise\Actions;

use Domain\Exercise\Exercise;
use Spatie\QueueableAction\QueueableAction;

final class LaunchInstance
{
    use QueueableAction;

    public function handle(Exercise $exercise)
    {
        dd("Launch instance for ", $exercise);
    }
}