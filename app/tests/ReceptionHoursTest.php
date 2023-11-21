<?php

namespace App\Tests;

use App\Dto\Request\ReceptionRequestDto;
use App\Repository\ReceptionHoursRepository;
use App\Service\ReceptionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ReceptionHoursTest extends WebTestCase
{
    public function testReceptionHoursAdd()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $validator = $this->createMock(ValidatorInterface::class);
        $receptionHoursRepository = $this->createMock(ReceptionHoursRepository::class);

        $sampleData = [
            'time' => '12:00',
        ];

        $receptionRequest = $this->createMock(ReceptionRequestDto::class);
        $receptionRequest->method('getTime')->willReturn($sampleData['time']);

        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $receptionService = new ReceptionService($entityManager, $validator, $receptionHoursRepository);

        $result = $receptionService->addReceptionHours($receptionRequest);

        $this->assertEquals(['id' => null, 'time' => '12:00'], $result);
    }
}
