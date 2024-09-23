<?php

declare(strict_types=1);

namespace Domain\Service;
use Domain\Entity\AMLHit;
use Domain\Entity\AMLMonitor;
use Domain\Entity\Owner;
use Domain\ValueObject\UUID;

class AMLMonitorService
{
    public function runMonitorForOwner(AMLMonitor $amlMonitor, Owner $owner): void {
        
        $amlChecks = $amlMonitor->getAMLChecks();
        $owner->resetAMLHits();
        
        foreach($amlChecks as $amlCheck) {

            foreach ($owner->getCompanies() as $ownerCompany) {

                if ($amlCheck->getCompany()->getId() == $ownerCompany->getId()) {

                    if (true == $amlCheck->run()) {
                        
                        // @TODO: generate new random UUID
                        $amlHit = new AMLHit(new UUID('uuid'));
                        
                        $owner->addAMLHit($amlHit);
                    

                    }
                }    
            }
        }
    }

}