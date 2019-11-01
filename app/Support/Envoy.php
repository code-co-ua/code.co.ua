<?php

namespace Support;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

final class Envoy
{
    /** @var string */
    private $task;

    /** @var string */
    private $arguments;

    public function task(string $task)
    {
        $this->task = $task;
        return $this;
    }

    public function arguments(array $arguments)
    {
        $this->arguments = collect($arguments)->map(function ($value, $key){
            return "--$key=$value";
        })->values()->implode(' ');

        return $this;
    }

    public function run(): string
    {
        $process = new Process([
            base_path('vendor/laravel/envoy/bin/envoy'), 'run', $this->task, $this->arguments
        ]);

        $process->setWorkingDirectory(base_path())->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }
}
