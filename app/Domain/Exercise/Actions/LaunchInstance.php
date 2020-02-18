<?php

declare(strict_types=1);

namespace Domain\Exercise\Actions;

use Domain\Exercise\DataObjects\InstanceDataObject;
use Spatie\QueueableAction\QueueableAction;
use Support\Envoy;

final class LaunchInstance
{
    use QueueableAction;

    // Wip
    public function execute(InstanceDataObject $instance, Envoy $envoy): void
    {
        $process = $envoy->arguments([
            'server' => '127.0.0.1',
            'course' => $instance->exercise->lesson->section->course->name,
            'exercise' => 'demo',
            'exercise_git_path' => 'https://github.com/crane-laravel/demo.git', // repository only for test
            'session_cookie' => 'test',
            'domain' => 'q3w2e5erty.s1.code.co.ua',
        ])->task('launch-instance')->run();
        dd($process);
    }
}
