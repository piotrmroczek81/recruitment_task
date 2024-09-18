<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class Owner
{
    private UUID $id;
    
    private array $companies = [];

    public function __construct(UUID $id)    {
        $this->id = $id;
    }    

    public function getCompanies(): array {
        return $this->companies;
    }

    public function addCompany(Company $company): void
    {
        $this->companies[] = $company;
    }
}