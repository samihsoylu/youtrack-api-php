<?php declare(strict_types=1);

namespace YouTrackAPI\Entity;

class Project
{
    public function __construct(
        private string $id,
        private string $name,
        private string $shortName,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }
}
