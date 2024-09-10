<?php

declare(strict_types=1);

// Domain Layer

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class AMLCheck
{
    private UUID $id;
    private string $name;
    private \DateTimeImmutable $executionDate;

    public function __construct(UUID $id, string $name, \DateTimeImmutable $executionDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->executionDate = $executionDate;
    }

    // Getters...
}
