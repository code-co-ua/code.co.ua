<?php

namespace Domain\Exercise\Enums;

class InstanceStatus
{
    public const UPDATING = 'Updating exercise';
    public const SETTING_AUTH = 'Setting-up authorization';
    public const RUNNING_IDE = 'Running ide instance';
    public const READY_TO_USE = 'Ready to use';
}
