<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\AMLCheck;
use Domain\Entity\AMLMonitor;
use Domain\ValueObject\UUID;
use PHPUnit\Framework\TestCase;

class AMLMonitorTest extends TestCase {
    
    public function testAMLMonitorCanHaveMultiplesAMLChecks(): void 
    {
        $amlMonitor = new AMLMonitor(new UUID('550e8400-e29b-41d4-a716-446655440001'));               
        $this->assertCount(0, $amlMonitor->getAMLChecks()); 
    
        $amlMonitor->addAMLCheck(
            new AMLCheck(new UUID('550e840-e29b-41d4-a716-446655440001'))
        );
        $this->assertCount(1, $amlMonitor->getAMLChecks()); 

        $amlMonitor->addAMLCheck(
            new AMLCheck(new UUID('550e840-e29b-41d4-a716-446655440001'))
        );
        $this->assertCount(2, $amlMonitor->getAMLChecks()); 
    }

    public function testAMLMonitorUseAMLChecks(): void
    {
        $amlMonitor = new AMLMonitor(new UUID('550e8400-e29b-41d4-a716-446655440001'));               
        
        $checkMock = $this->createMock(AMLCheck::class);
        $checkMock->expects($this->once())->method('run');
        $amlMonitor->addAMLCheck(
            $checkMock
        );

        $checkMock = $this->createMock(AMLCheck::class);
        $checkMock->expects($this->once())->method('run');
        $amlMonitor->addAMLCheck(
            $checkMock
        );

        $amlMonitor->runMonitor();
    }
}