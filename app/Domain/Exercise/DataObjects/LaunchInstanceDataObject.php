<?php declare(strict_types=1);

namespace Domain\Exercise\DataObjects;

use Domain\Exercise\Exercise;
use Domain\Exercise\Instance;
use Domain\User\User;
use Spatie\DataTransferObject\DataTransferObject;

class LaunchInstanceDataObject extends DataTransferObject
{
    public string $server;

    public string $domain;

    public ?Instance $instance = null;

    public Exercise $exercise;

    public User $user;

    public string $courseDirectory;

    public string $exerciseDirectory;

    public string $exerciseGitPath;

    public string $sessionId;

}