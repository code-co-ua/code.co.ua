<?php

namespace Domain\Exercise\Actions;

use Support\Envoy;
use Domain\Exercise\Server;
use Spatie\QueueableAction\QueueableAction;

final class PrepareServer
{
    use QueueableAction;

    public function execute(Server $server): void
    {
        (new Envoy)
            ->task('server-prepare')
            ->arguments(['server' => $server->host])
            ->run();
    }
}
