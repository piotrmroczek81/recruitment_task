<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use PHPUnit\Framework\TestCase;
use Domain\Entity\AMLMonitor;
use Domain\Entity\AMLCheck;
use Domain\Entity\Company;
use Domain\Entity\Owner;
use Domain\ValueObject\UUID;

class AMLTest extends TestCase {
    
    public function testCompanyRiskLevels() {
        $company = new Company(new UUID('550e8400-e29b-41d4-a716-446655440000'), 'Test Company');
        $owner1 = new Owner(new UUID('550e8400-e29b-41d4-a716-446655440000'), 'Test Owner Firstname', 'Test Owner Lastname');
        $owner2 = new Owner(new UUID('550e8400-e29b-41d4-a716-446655440000'), 'Test Owner Lastname', 'Test Owner Lastname');
        
        // Add owners to the company
        $company->addOwner($owner1);
        $company->addOwner($owner2);
    
    }
    
    public function testAMLMonitor() {

        $owner = new Owner(new UUID('550e8400-e29b-41d4-a716-446655440000'), 'Test Owner Firstname', 'Test Owner Lastname');


        $amlMonitor = new AMLMonitor(
            new UUID('550e8400-e29b-41d4-a716-446655440000'),
            'Test Monitor'
        );

        $amlCheck = new AMLCheck(
            new UUID('550e8400-e29b-41d4-a716-446655440001'),
            'Test Check',
            new \DateTimeImmutable()
        );
        
        // Add check to the monitor
        $amlMonitor->addCheck($amlCheck);
        

    }
}