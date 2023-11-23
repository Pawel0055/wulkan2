<?php

namespace App\Tests;

use App\Dto\Request\BookingRequestDto;
use App\Repository\BookingRepository;
use App\Repository\ReceptionHoursRepository;
use App\Service\BookingService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BookingTest extends WebTestCase
{
    public function testBookingAdd()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $validator = $this->createMock(ValidatorInterface::class);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $bookingRepository = $this->createMock(BookingRepository::class);
        $receptionHoursRepository = $this->createMock(ReceptionHoursRepository::class);

        $sampleData = [
            "registrationNumber" => "ZS78AJ",
            "date" => "2023-12-12",
            "time" => "02:03",
        ];

        $bookingRequest = $this->createMock(BookingRequestDto::class);
        $bookingRequest->expects($this->once())->method('getTime')->willReturn($sampleData['time']);
        $bookingRequest->expects($this->atLeastOnce())->method('getDate')->willReturn($sampleData['date']);
        $bookingRequest->expects($this->atLeastOnce())->method('getRegistrationNumber')->willReturn($sampleData['registrationNumber']);

        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        // Stwórz obiekt BookingService i wywołaj metodę addBooking
        $bookingService = new BookingService($entityManager, $validator, $eventDispatcher, $bookingRepository, $receptionHoursRepository);
        $result = $bookingService->addBooking($bookingRequest);

        // Oczekiwany wynik
        $expectedResult = [
            'id' => null,
            'registrationNumber' => $sampleData['registrationNumber']
        ];

        // Sprawdź, czy wynik jest zgodny z oczekiwaniem
        $this->assertEquals($expectedResult, $result);
    }
}
