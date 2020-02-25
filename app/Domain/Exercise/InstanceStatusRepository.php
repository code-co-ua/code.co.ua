<?php

namespace Domain\Exercise;

use Closure;
use Illuminate\Redis\RedisManager;

class InstanceStatusRepository
{
    private RedisManager $redis;

    public function __construct(RedisManager $redis)
    {
        $this->redis = $redis;
    }

    public function get(Instance $instance): ?string
    {
        return $this->redis->get($instance->status_key);
    }

    public function set(Instance $instance, string $status): string
    {
        $this->redis->publish("user.{$instance->user_id}", json_encode([
            $instance->status_key => $status
        ]));

        return $status;
    }

    public function listenForChanges(Instance $instance, Closure $closure): void
    {
        $this->redis->subscribe(["user.{$instance->user_id}"], function ($message) use ($closure) {
            $closure($message);
        });
    }
}