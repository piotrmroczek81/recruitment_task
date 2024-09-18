<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\ValueObject\UUID;

class AMLMonitor
{
    private UUID $id;

    private array $amlChecks = [];

    public function __construct(UUID $id)    {
        $this->id = $id;
    }        

    
    public function getAMLChecks(): array
    {
        return $this->amlChecks;
    }

    public function addAMLCheck(AMLCheck $amlCheck): void
    {
        $this->amlChecks[] = $amlCheck;
    }


    public function runMonitor(): void {

        foreach($this->amlChecks as $amlCheck) {
            $amlCheck->run();
        }

    }
}
