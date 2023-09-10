<?php

namespace App\Controller;

use App\Dto\Request\ReceptionRequestDto;
use App\Service\ReceptionService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/reception', name: 'reception_')]
class ReceptionHoursController extends AbstractController
{
    public function __construct(private SerializerInterface    $serializer,
    private ValidatorInterface     $validator,
    private ReceptionService $receptionService,
    private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/add', name: 'add', methods:['post'] )]
    public function addReceptionHours(Request $request)
    {
        try {
            /** @var ReceptionRequestDto $bookingRequest */
            $receptionRequest = $this->serializer->deserialize(
                $request->getContent(),
                ReceptionRequestDto::class,
                'json'
            );
            $receptionHours = $this->receptionService->addReceptionHours($receptionRequest);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return $this->json($receptionHours);
    }
}
