<?php

declare(strict_types=1);

// Domain Layer

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class Company
{
    private UUID $id;
    private string $name;
    private array $owners = [];

    public function __construct(UUID $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function addOwner(Owner $owner): void
    {
        $this->owners[] = $owner;
    }

    public function getRiskLevel() {
        $totalHits = 0;
        foreach ($this->owners as $owner) {
            $totalHits += $owner->getTotalAMLHits();
        }
        
        if ($totalHits >= 4) {
            return 'High risk Company';
        } elseif ($totalHits >= 2) {
            return 'Medium risk Company';
        } else {
            return 'Low risk Company';
        }
    }
}