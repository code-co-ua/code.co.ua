<?php declare(strict_types=1);

namespace Domain\Exercise\DataObjects;

use Domain\Exercise\Exercise;
use Spatie\DataTransferObject\DataTransferObject;

class InstanceDataObject extends DataTransferObject
{
    public string $server;

    public string $domain;

    public Exercise $exercise;

    public string $courseDirectory;

    public string $exerciseDirectory;

    public string $exerciseGitPath;

    public string $sessionId;
}