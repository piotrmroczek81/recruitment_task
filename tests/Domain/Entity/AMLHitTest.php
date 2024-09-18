<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\Owner;
use Domain\ValueObject\UUID;
use PHPUnit\Framework\TestCase;

class AMLHitTest extends TestCase {
    public function testOwnerCanHaveMultipleAMLHits(): void 
    {
        $owner = new Owner(new UUID('550e8400-e29b-41d4-a716-446655440000'));


    }


}