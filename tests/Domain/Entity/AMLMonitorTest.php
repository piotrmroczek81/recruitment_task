<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\AMLMonitor;
use Domain\ValueObject\UUID;
use PHPUnit\Framework\TestCase;

class AMLMonitorTest extends TestCase {
    
    public function testAMLMonitorCanHaveMultiplesAMLChecks(): void 
    {
        $amlMonitor = new AMLMonitor(new UUID('550e8400-e29b-41d4-a716-446655440001'));               
        $this->assertCount(0, $amlMonitor->getAMLChecks()); 
    }


}