<?php

namespace Domain\Exercise\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static ServerStatusEnum PREPARING()
 * @method static ServerStatusEnum AVAILABLE()
 * @method static ServerStatusEnum UNAVAILABLE()
 */
final class ServerStatusEnum extends Enum
{
    const __default = self::PREPARING;

    const PREPARING = 'preparing';

    const AVAILABLE = 'available';

    const UNAVAILABLE = 'unavailable';
}
