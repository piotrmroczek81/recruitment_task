<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class Company
{
    private UUID $id;

    private array $owners = [];
    
    public function __construct(UUID $id)    {
        $this->id = $id;
    }    

    public function getId(): UUID {
        return $this->id;
    }

    public function addOwner(Owner $owner): void
    {
        $this->owners[] = $owner;
    }


    public function getOwners(): array
    {
        return $this->owners;
    }



}