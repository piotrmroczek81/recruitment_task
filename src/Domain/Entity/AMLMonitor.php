<?php

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class AMLMonitor
{
    private UUID $id;
    private string $name;
    private array $checks = [];

    public function __construct(UUID $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addCheck(AMLCheck $check): void
    {
        $this->checks[] = $check;
    }

    public function getChecks(): array
    {
        return $this->checks;
    }
}