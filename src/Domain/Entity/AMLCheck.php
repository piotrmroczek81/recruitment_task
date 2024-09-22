<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class AMLCheck
{
    private UUID $id;
    private Company $company;

    public function __construct(UUID $id, Company $company)   {
        $this->id = $id;
        $this->company = $company;
    }
    
    public function getCompany(): Company {
        return $this->company;
    }


    

    public function run(): void {

    }
}
