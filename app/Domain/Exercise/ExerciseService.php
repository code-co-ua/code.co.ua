<?php declare(strict_types=1);

namespace Domain\Exercise;

use Domain\Exercise\DataObjects\LaunchInstanceDataObject;
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

    public function launchInstance(Exercise $exercise, string $sessionId): Instance
    {
        $data = new LaunchInstanceDataObject([
            'server' => '127.0.0.1',
            'exercise' => $exercise,
            'user' => $this->auth->guard()->user(),
            'exerciseDirectory' => $exercise->slug,
            'courseDirectory' => $exercise->lesson->section->course->slug,
            'exerciseGitPath' => 'https://github.com/crane-laravel/demo.git', // repository only for test
            'sessionId' => $sessionId,
            'domain' => 'q3w2e5erty.s1.code.co.ua',
        ]);

        $data->instance = Instance::create([
            'exercise_id' => $data->exercise->id,
            'server_id' => 1, // todo - server integration
            'user_id' => $data->user->id,
            'url' => $data->domain,
        ]);

        $this->dispatch(new LaunchExerciseJob($data));

        return $data->instance;
    }
}
