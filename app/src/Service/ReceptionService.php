<?php

namespace App\Service;

use App\Entity\ReceptionHours;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;

class ReceptionService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface     $validator,
    )
    {
    }

    public function addReceptionHours($request)
    {
        $errors = $this->validator->validate($request);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }

        $receptionHour = $this->entityManager
            ->getRepository(ReceptionHours::class)
            ->findOneByTime(new DateTime($request->getTime()));
            
        if($receptionHour) {
            return new Response('Taka godzina już istnieje.');
        }

        $receptionHour = new ReceptionHours();
        $receptionHour->setTime(new DateTime($request->getTime()));

        $this->entityManager->persist($receptionHour);
        $this->entityManager->flush();
   
        $data =  [
            'id' => $receptionHour->getId(),
            'time' => $receptionHour->getTime()->format('H:i')
        ];

        return $data;
    }
}