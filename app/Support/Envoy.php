<?php

namespace Support;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

final class Envoy
{
    private string $task;

    private string $arguments;

    public function task(string $task): self
    {
        $this->task = $task;
        return $this;
    }

    public function arguments(array $arguments): self
    {
        $this->arguments = collect($arguments)->map(function ($value, $key) {
            return "--$key=$value";
        })->values()->implode(' ');

        return $this;
    }

    public function run(): string
    {
        $process = new Process([
            base_path('vendor/bin/envoy'), 'run', $this->task, $this->arguments
        ]);

        $process->setWorkingDirectory(base_path())->run();

        if (!$process->isSuccessful()) {
            dd($process->getCommandLine());
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }
}