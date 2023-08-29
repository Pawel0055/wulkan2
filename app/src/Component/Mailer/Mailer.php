<?php

namespace App\Component\Mailer;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface as SymfonyMailerInterface;
use Symfony\Component\Mime\Email;

class Mailer implements MailerInterface
{
    public function __construct(private SymfonyMailerInterface $mailer, private EntityManagerInterface $entityManager)
    {
    }

    public function sendAddBookingtInformation($email): Email
    {
        return $this->sendEmailMessage(
            'Otrzymałeś nową wiadomość (Dodanie terminu)',
            $email,
            'Nowy termin został pomyślnie dodany.'
        );
    }

    protected function sendEmailMessage(string $subject, string $to, string $message): Email
    {
        $email = (new Email())
            ->from('wulkanizator@example.com')
            ->to($to)
            ->subject($subject)
            ->text($message);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            throw new Exception($e->getMessage());
        }
        return $email;
    }
}
