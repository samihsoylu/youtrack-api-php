<?php declare(strict_types=1);

namespace YouTrackAPI\Entity\Issue\WorkItem;

class Duration
{
    public function __construct(
        private string $id,
        private int $minutes,
        private string $presentation,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMinutes(): int
    {
        return $this->minutes;
    }

    public function getPresentation(): string
    {
        return $this->presentation;
    }
}
