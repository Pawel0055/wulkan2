<?php

namespace App\Service;

use App\Entity\Booking;
use App\Entity\ReceptionHours;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Event\BookingConfirmedEvent;

class BookingService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface     $validator,
        private EventDispatcherInterface $dispatcher
    )
    {
    }

    public function addBooking($request)
    {
        $errors = $this->validator->validate($request);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }
    
        $receptionHour = $this->entityManager
            ->getRepository(ReceptionHours::class)
            ->findOneByTime(new DateTime($request->getTime()));
    
        $registrationNumber = $this->entityManager
        ->getRepository(Booking::class)
        ->findOneByRegistrationNumber($request->getRegistrationNumber());
        
        if(!$receptionHour || $registrationNumber) {
            return new Response('Niepoprawne dane.');
        }

        $busyBooking = $this->entityManager
        ->getRepository(Booking::class)
        ->findBy([
            'receptionHours' => $receptionHour,
            'date' => new DateTimeImmutable($request->getDate())
        ]);
        
        if($busyBooking) {
            return new Response('Godzina zajeta');
        }

        $booking = new Booking();
        $booking->setRegistrationNumber($request->getRegistrationNumber());
        $booking->setDate(new DateTimeImmutable($request->getDate()));
        $booking->setReceptionHours($receptionHour);

        $this->entityManager->persist($booking);
        $this->entityManager->flush();
   
        $data =  [
            'id' => $booking->getId(),
            'registrationNumber' => $booking->getRegistrationNumber(),
            'date' => $booking->getDate(),
            'time' => $booking->getReceptionHours()->getTime()->format('H:i')
        ];

        $event = new BookingConfirmedEvent($booking);
        $this->dispatcher->dispatch($event, BookingConfirmedEvent::NAME);

        return $data;
    }
}