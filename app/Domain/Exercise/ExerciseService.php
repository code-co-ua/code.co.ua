<?php declare(strict_types=1);

namespace Domain\Exercise;

use Domain\Exercise\DataObjects\InstanceDataObject;
use Domain\Exercise\Jobs\LaunchExerciseJob;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Bus\DispatchesJobs;

final class ExerciseService
{
    use DispatchesJobs;

    private AuthManager $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function launchInstance(Exercise $exercise, string $sessionId): void
    {
        $this->dispatch(new LaunchExerciseJob(
            new InstanceDataObject([
                'server' => '127.0.0.1',
                'exercise' => $exercise,
                'user' => $this->auth->guard()->user(),
                'exerciseDirectory' => $exercise->slug,
                'courseDirectory' => $exercise->lesson->section->course->slug,
                'exerciseGitPath' => 'https://github.com/crane-laravel/demo.git', // repository only for test
                'sessionId' => $sessionId,
                'domain' => 'q3w2e5erty.s1.code.co.ua',
            ]),
        ));
    }
}