<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class AMLMonitorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testTrue() 
    {
        $this->assertTrue(true);
    }
}