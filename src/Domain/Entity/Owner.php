<?php

declare(strict_types=1);




namespace Domain\Entity;

use Domain\ValueObject\UUID;

class Owner
{
    private UUID $id;
    private string $firstName;
    private string $lastName;
    private array $companies = [];
    private array $amlHits = [];

    public function __construct(UUID $id, string $firstName, string $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getTotalAMLHits() {
        return $this->amlHits;
    }


    
    public function accumulateAMLHit() {

    }
    
}