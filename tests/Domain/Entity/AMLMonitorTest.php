<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use PHPUnit\Framework\TestCase;
use Domain\Entity\AMLMonitor;
use Domain\Entity\AMLCheck;
use Domain\ValueObject\UUID;

class AMLMonitorTest extends TestCase
{
    private AMLMonitor $monitor;

    protected function setUp(): void
    {
        $this->monitor = new AMLMonitor(
            new UUID('550e8400-e29b-41d4-a716-446655440000'),
            'Test Monitor'
        );
    }

    public function testCreateMonitor(): void
    {
        $this->assertInstanceOf(AMLMonitor::class, $this->monitor);
        $this->assertEquals('Test Monitor', $this->monitor->getName());
        $this->assertEquals('550e8400-e29b-41d4-a716-446655440000', $this->monitor->getId()->getValue());
    }

    public function testAddCheck(): void
    {
        $check = new AMLCheck(
            new UUID('550e8400-e29b-41d4-a716-446655440001'),
            'Test Check',
            new \DateTimeImmutable()
        );

        $this->monitor->addCheck($check);

        $this->assertCount(1, $this->monitor->getChecks());
        $this->assertSame($check, $this->monitor->getChecks()[0]);
    }

    public function testGetChecks(): void
    {
        $this->assertEmpty($this->monitor->getChecks());

        $check1 = new AMLCheck(
            new UUID('550e8400-e29b-41d4-a716-446655440001'),
            'Test Check 1',
            new \DateTimeImmutable()
        );
        $check2 = new AMLCheck(
            new UUID('550e8400-e29b-41d4-a716-446655440002'),
            'Test Check 2',
            new \DateTimeImmutable()
        );

        $this->monitor->addCheck($check1);
        $this->monitor->addCheck($check2);

        $checks = $this->monitor->getChecks();
        $this->assertCount(2, $checks);
        $this->assertSame($check1, $checks[0]);
        $this->assertSame($check2, $checks[1]);
    }
}