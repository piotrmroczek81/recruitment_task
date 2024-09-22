<?php

declare(strict_types=1);

namespace Domain\Service;
use Domain\Entity\AMLMonitor;
use Domain\Entity\Owner;
use Domain\Repository\MonitorRepository;
use Domain\Entity\AMLCheck;

class AMLMonitorService
{
    public function runMonitorForOwner(AMLMonitor $amlMonitor, Owner $owner): void {
        
        $amlChecks = $amlMonitor->getAMLChecks();
            
        foreach($amlChecks as $amlCheck) {

            foreach ($owner->getCompanies() as $ownerCompany) {

                if ($amlCheck->getCompany()->getId() == $ownerCompany->getId()) {

                    $amlCheck->run();
                }    
            }
        }
    }

}