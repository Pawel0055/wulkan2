<?php

namespace App\Controller;

use App\Entity\ReceptionHours;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/reception', name: 'reception_')]
class ReceptionHoursController extends AbstractController
{
    public function __construct(private SerializerInterface    $serializer,
                                private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/add', name: 'add', methods:['post'] )]
    public function addReceptionHours(Request $request): JsonResponse
    {
        $receptionHour = $this->entityManager
            ->getRepository(ReceptionHours::class)
            ->findOneByTime(new DateTime($request->request->get('time')));
            
        if($receptionHour) {
            return $this->json(['error' => 'Taka godzina już istnieje.']);
        }

        $receptionHour = new ReceptionHours();
        $receptionHour->setTime(new DateTime($request->request->get('time')));

        $this->entityManager->persist($receptionHour);
        $this->entityManager->flush();
   
        $data =  [
            'id' => $receptionHour->getId(),
            'time' => $receptionHour->getTime()->format('H:i')
        ];
           
        return $this->json($data);
    }
}
