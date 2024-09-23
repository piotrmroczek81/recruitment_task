<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class AMLHit
{
    private UUID $id;
    

    private array $companies = [];


    public function __construct(UUID $id)    {
        $this->id = $id;
    }    
}