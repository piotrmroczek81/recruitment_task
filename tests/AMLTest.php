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
        $owner1 = new Owner(new UUID('550e8400-e29b-41d4-a716-446655440000'), 'Test Owner Firstname');
        $owner2 = new Owner(new UUID('550e8400-e29b-41d4-a716-446655440000'), 'Test Owner Lastname');
        
        // Add owners to the company
        $company->addOwner($owner1);
        $company->addOwner($owner2);
        
        // Test Low Risk
        $this->assertEquals('Low risk Company', $company->getRiskLevel());
        
        // Accumulate AML Hits
        $owner1->accumulateAMLHit(); // 1 hit
        $this->assertEquals('Low risk Company', $company->getRiskLevel());
        
        $owner1->accumulateAMLHit(); // 2 hits
        $this->assertEquals('Medium risk Company', $company->getRiskLevel());
        
        $owner1->accumulateAMLHit(); // 3 hits
        $this->assertEquals('Medium risk Company', $company->getRiskLevel());
        
        $owner1->accumulateAMLHit(); // 4 hits
        $this->assertEquals('High risk Company', $company->getRiskLevel());
        
        // Reset AML Hits
        $owner1->resetAMLHits();
        $this->assertEquals('Low risk Company', $company->getRiskLevel());
    }
    
    public function testAMLMonitor() {
        $owner = new Owner();
        $amlMonitor = new AMLMonitor();
        $amlCheck = new AMLCheck();
        
        // Add check to the monitor
        $amlMonitor->addCheck($amlCheck);
        
        // Run checks
        $amlMonitor->runChecksAgainstOwners([$owner]);
        
        // Check if owner accumulated an AML Hit
        $this->assertEquals(1, $owner->getTotalAMLHits());
        
        // Reset AML Hits
        $owner->resetAMLHits();
        $this->assertEquals(0, $owner->getTotalAMLHits());
    }
}