<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\Company;
use Domain\Entity\Owner;
use PHPUnit\Framework\TestCase;
use Domain\ValueObject\UUID;

class CompanyTest extends TestCase {

    public function testCompanyCanHaveMultipleOwners(): void 
    {
        $company = new Company(new UUID('550e8400-e29b-41d4-a716-446655440000'));

        $owners = $company->getOwners();
        $this->assertCount(0, $owners);        


        $company->addOwner(
            new Owner(new UUID('550e8400-e29b-41d4-a716-446655440001'))
        );        
        $owners = $company->getOwners();
        $this->assertCount(1, $owners);        


        $company->addOwner(
            new Owner(new UUID('550e8400-e29b-41d4-a716-446655440002'))
        );        
        $owners = $company->getOwners();
        $this->assertCount(2, $owners);
    }
}