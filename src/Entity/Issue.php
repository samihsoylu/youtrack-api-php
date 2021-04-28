<?php declare(strict_types=1);

namespace YouTrackAPI\Entity;

use YouTrackAPI\HttpClient\Entity\Issue\CustomField;

class Issue
{
    public const FIELD_STATE = 'State';

    /** @var CustomField[] */
    private array $customFields;

    public function __construct(
        private string $identifier,
        private string $summary,
        private string $description,
        array $customFields,
    ) {
        $this->customFields = $customFields;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return CustomField[]
     */
    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    protected function getCustomField($fieldName): string
    {
        foreach ($this->customFields as $customField) {
            if ($customField->getName() === $fieldName) {
                return $customField->getValue()->getName();
            }
        }

        throw new \RuntimeException("CustomField with name {$fieldName} was not found");
    }

    public function getState(): string
    {
        return $this->getCustomField(self::FIELD_STATE);
    }
}
