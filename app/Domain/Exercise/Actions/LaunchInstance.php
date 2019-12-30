<?php

declare(strict_types=1);

namespace Domain\Exercise\Actions;

use Domain\Exercise\Exercise;
use Spatie\QueueableAction\QueueableAction;

final class LaunchInstance
{
    use QueueableAction;

    public function execute(Exercise $exercise)
    {
        dump("Launch instance for ", $exercise);
    }
}
