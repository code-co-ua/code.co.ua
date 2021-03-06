<?php

namespace Domain\Exercise\Jobs;

use Domain\Exercise\DataObjects\LaunchInstanceDataObject;
use Domain\Exercise\Enums\InstanceStatus;
use Domain\Exercise\InstanceStatusRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};
use Illuminate\Support\Str;
use Support\Envoy;

class LaunchExerciseJob implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    public const CONSOLE_START_WITH = ':';
    public const CONSOLE_ENDS_WITH = ':!%:';

    private LaunchInstanceDataObject $data;

    public function __construct(LaunchInstanceDataObject $data)
    {
        $this->data = $data;
    }

    public function handle(Envoy $envoy, InstanceStatusRepository $instanceStatus)
    {
        $instance = $this->data->instance;
        $envoy->task('launch-instance')
            ->arguments($this->data->toArray())
            ->run(function ($type, $buffer) use ($instance, $instanceStatus) {
                if (!Str::contains($buffer, self::CONSOLE_START_WITH)) {
                    return false;
                }

                $key = trim(
                    Str::between($buffer, self::CONSOLE_START_WITH, self::CONSOLE_ENDS_WITH)
                );
                $value = trim(
                    Str::after($buffer, self::CONSOLE_ENDS_WITH)
                );

                switch ($key = Str::lower($key)) {
                    case 'status':
                        $instanceStatus->set($instance, $value);
                        break;
                    case 'container':
                        $instanceStatus->set($instance, InstanceStatus::READY_TO_USE);
                        $instance->update(['container_id' => $value]);
                        break;
                }
            });
    }

    /**
     * Horizon tags
     * @link https://laravel.com/docs/6.x/horizon
     */
    public function tags(): array
    {
        return [
            'user:'.$this->data->user->id,
            'lesson:'.$this->data->exercise->lesson_id,
            'exercise:'.$this->data->exercise->id,
        ];
    }
}