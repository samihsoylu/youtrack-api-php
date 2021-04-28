<?php declare(strict_types=1);

namespace YouTrackAPI\Entity\Issue;

use YouTrackAPI\Entity\Issue\CustomField\Value;

class CustomField
{
    public function __construct(
        private string $name,
        private string $type,
        private ?Value $value = null,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): ?Value
    {
        return $this->value;
    }
}
