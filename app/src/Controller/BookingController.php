<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\ReceptionHours;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/booking', name: 'booking_')]
class BookingController extends AbstractController
{
    public function __construct(private SerializerInterface    $serializer,
                                private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/get', name: 'get', methods:['get'] )]
    public function getBookings(): JsonResponse
    {
        $bookings = $this->entityManager
            ->getRepository(Booking::class)
            ->findAll();
   
        $data = [];
   
        foreach ($bookings as $booking) {
           $data[] = [
               'id' => $booking->getId(),
               'registrationNumber' => $booking->getRegistrationNumber(),
               'date' => $booking->getDate()->format('Y-m-d'),
               'time' => $booking->getReceptionHours()->getTime()->format('H:i')
           ];
        }
   
        return $this->json($data);
    }

    #[Route('/get/{id}', name: 'get_by_id', methods:['get'] )]
    public function getBooking(int $id): JsonResponse
    {
        $booking = $this->entityManager
            ->getRepository(Booking::class)
            ->findOneById($id);
    
        if($booking) {
        $data = [
            'id' => $booking->getId(),
            'registrationNumber' => $booking->getRegistrationNumber(),
            'date' => $booking->getDate()->format('Y-m-d'),
            'time' => $booking->getReceptionHours()->getTime()->format('H:i')
        ];
        return $this->json($data);
        } else {
            return $this->json(['error' => 'Niepoprawne dane']);
        }
    }

    #[Route('/add', name: 'add', methods:['post'] )]
    public function addBooking(Request $request): JsonResponse
    {
        $receptionHour = $this->entityManager
            ->getRepository(ReceptionHours::class)
            ->findOneByTime(new DateTime($request->request->get('time')));
        if(!$receptionHour) {
            return $this->json(['error' => 'Niepoprawne dane']);
        }
        $booking = new Booking();
        $booking->setRegistrationNumber($request->request->get('registrationNumber'));
        $booking->setDate(new DateTimeImmutable($request->request->get('date')));
        $booking->setReceptionHours($receptionHour);

        $this->entityManager->persist($booking);
        $this->entityManager->flush();
   
        $data =  [
            'id' => $booking->getId(),
            'registrationNumber' => $booking->getRegistrationNumber(),
            'date' => $booking->getDate(),
            'time' => $booking->getReceptionHours()->getTime()->format('H:i')
        ];
           
        return $this->json($data);
    }
}
