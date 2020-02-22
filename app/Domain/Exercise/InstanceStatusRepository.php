<?php

namespace Domain\Exercise;

use Closure;
use Illuminate\Contracts\Redis\Factory;

class InstanceStatusRepository
{
    private Factory $redis;

    public function __construct(Factory $redis)
    {
        $this->redis = $redis;
    }

    public function get(Instance $instance): ?string
    {
        return $this->redis->get("instance:{$instance->id}");
    }

    public function set(Instance $instance, string $status): string
    {
        $this->redis->publish("user.{$instance->user_id}", json_encode([
            "instance:{$instance->id}" => $status
        ]));

        return $status;
    }

    public function listenForChanges(Instance $instance, Closure $closure): void
    {
        $this->redis->subscribe("user.{$instance->user_id}", function ($message, $channel) use ($closure) {
            $closure($message, $channel);
        });
    }
}