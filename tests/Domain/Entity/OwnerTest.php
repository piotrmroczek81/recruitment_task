<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\Company;
use Domain\Entity\Owner;
use Domain\ValueObject\UUID;
use PHPUnit\Framework\TestCase;

class OwnerTest extends TestCase {

    public function testOwnerCanHaveMultipleCompanies(): void 
    {
        $owner = new Owner(new UUID('550e8400-e29b-41d4-a716-446655440000'));

        $companies = $owner->getCompanies();
        $this->assertCount(0, $companies); 

        $owner->addCompany(
            new Company(new UUID('550e8400-e29b-41d4-a716-446655440001'))
        );            
        $this->assertCount(1, $owner->getCompanies()); 


        $owner->addCompany(
            new Company(new UUID('550e8400-e29b-41d4-a716-446655440002'))
        );            
        $this->assertCount(2, $owner->getCompanies()); 
    }
}