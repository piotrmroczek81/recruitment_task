<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class Owner
{
    private UUID $id;
    
    public function __construct(UUID $id)    {
        $this->id = $id;
    }    
}