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
    public const __default = self::PREPARING;

    public const PREPARING = 'preparing';

    public const AVAILABLE = 'available';

    public const UNAVAILABLE = 'unavailable';
}
