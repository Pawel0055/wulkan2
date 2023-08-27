<?php

namespace App\Controller;

use App\Entity\Booking;
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

    #[Route(name: 'add', methods: ['POST'])]
    public function addOffice(Request $request): JsonResponse
    {
        $booking = new Booking();
        $booking->setRegistrationNumber($request->request->get('registrationNumber'));
        $booking->setDate(new DateTimeImmutable($request->request->get('date')));

        $this->entityManager->persist($booking);
        $this->entityManager->flush();
   
        $data =  [
            'id' => $booking->getId(),
            'registrationNumber' => $booking->getRegistrationNumber(),
            'date' => $booking->getDate(),
        ];
           
        return $this->json($data);
    }
}
