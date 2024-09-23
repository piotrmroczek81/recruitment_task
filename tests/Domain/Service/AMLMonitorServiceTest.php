<?php

declare(strict_types=1);

namespace Tests\Domain\Service;

use Domain\Entity\AMLCheck;
use Domain\Entity\AMLHit;
use Domain\Entity\Company;
use Domain\Service\AMLMonitorService;
use PHPUnit\Framework\TestCase;
use Domain\Entity\AMLMonitor;
use Domain\Entity\Owner;
use Domain\ValueObject\UUID;
use Domain\Repository\MonitorRepository;

class AMLMonitorServiceTest extends TestCase {


    public function testRunAMLMonitorForOwnerPerformsHisChecks(): void 
    {
        $AMLMonitorService = new AMLMonitorService();            
        $owner = new Owner(new UUID('550e8400-e29b-41d4-a716-446655440000'));
        
        $company = new Company(new UUID('550e8400-e29b-41d4-a716-446655440000'));
        $company->addOwner($owner); 
        $owner->addCompany($company);


        $checkMockA = $this->createMock(AMLCheck::class);
        $checkMockA->expects($this->any())
            ->method('getCompany')
            ->willReturn($company);

        $checkMockA->expects($this->once())->method('run');
        

        $checkMockB = $this->createMock(AMLCheck::class);
        $checkMockB->expects($this->any())
            ->method('getCompany')
            ->willReturn($company);



        $checkMockB->expects($this->once())->method('run');
        

        $anotherCompany = new Company(new UUID('550e8400-e29b-41d4-a716-446655440001'));
        $checkShouldOmmitedMock = $this->createMock(AMLCheck::class);
        $checkShouldOmmitedMock->expects($this->any())
            ->method('getCompany')
            ->willReturn($anotherCompany);

        $checkShouldOmmitedMock->expects($this->never())->method('run');
        

        $amlMonitor = new AMLMonitor(new UUID('550e8400-e29b-41d4-a716-446655440000'));

        $amlMonitor->addAMLCheck(
            $checkMockA
        );
        $amlMonitor->addAMLCheck(
            $checkMockB
        );
        $amlMonitor->addAMLCheck(
            $checkShouldOmmitedMock
        );


        $AMLMonitorService->runMonitorForOwner
        (   
            $amlMonitor,
            $owner     
        );

    }

    public function testEachRunMonitorResetAMLHits(): void 
    {     
        $amlMonitor = new AMLMonitor(new UUID('550e8400-e29b-41d4-a716-446655440000'));
        $ownerMock = $this->createMock(Owner::class);
        $ownerMock->expects($this->once())->method('resetAMLHits');


        $AMLMonitorService = new AMLMonitorService();                    
        
        $AMLMonitorService->runMonitorForOwner
        (   
            $amlMonitor,
            $ownerMock     
        );
    }

    public function testOwnerAccumulateAMLHitsAfetrMonitorRun(): void 
    {

        $company = new Company(new UUID('550e8400-e29b-41d4-a716-446655440000'));

        $amlMonitor = new AMLMonitor(new UUID('550e8400-e29b-41d4-a716-446655440000'));
        $ownerMock = $this->createMock(Owner::class);
        $ownerMock->expects($this->once())->method('addAMLHit');
        $ownerMock->expects($this->any())
            ->method('getCompanies')
            ->willReturn([$company]);



        $checkMockA = $this->createMock(AMLCheck::class);
        $checkMockA->expects($this->any())
            ->method('run')
            ->willReturn(true);
        $checkMockA->expects($this->any())
            ->method('getCompany')
            ->willReturn($company);


        $amlMonitor->addAMLCheck(
            $checkMockA
        );
        $AMLMonitorService = new AMLMonitorService();                    
    

        $AMLMonitorService->runMonitorForOwner
        (   
            $amlMonitor,
            $ownerMock     
        );

    }

}