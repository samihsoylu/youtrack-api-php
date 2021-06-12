<?php declare(strict_types=1);

namespace YouTrackAPI\Entity\Issue;

use YouTrackAPI\Entity\Issue\WorkItem\Creator;
use YouTrackAPI\Entity\Issue\WorkItem\Duration;
use YouTrackAPI\Entity\Issue\WorkItem\Type;
use YouTrackAPI\Util\Struct;

/**
 * Class WorkItem represents a single time tracking record for an issue in YouTrack
 */
class WorkItem
{
    private ?Duration $duration = null;
    private ?Type $type = null;
    private ?Creator $creator = null;

    private function __construct(
        private string $id,
        private string $text,
        private int $date,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function getCreator(): ?Creator
    {
        return $this->creator;
    }

    public static function fromArray(array $struct): self
    {
        $self = new self(
            $struct['id'],
            $struct['text'] ?? '',
            $struct['date'],
        );

        $durationStruct = $struct['duration'] ?? null;
        if (Struct::hasRequiredFields($durationStruct, ['minutes', 'presentation', 'id'])) {
            $duration = new Duration(
                $durationStruct['id'],
                $durationStruct['minutes'],
                $durationStruct['presentation'],
            );
            $self->duration = $duration;
        }

        $typeStruct = $struct['type'] ?? null;
        if (Struct::hasRequiredFields($typeStruct, ['id', 'name'])) {
            $type = new Type(
                $typeStruct['id'],
                $typeStruct['name'],
            );

            $self->type = $type;
        }

        $creatorStruct = $struct['creator'] ?? null;
        if (Struct::hasRequiredFields($creatorStruct, ['id', 'name'])) {
            $creator = new Creator(
                $creatorStruct['id'],
                $creatorStruct['name'],
            );

            $self->creator = $creator;
        }

        return $self;
    }
}
