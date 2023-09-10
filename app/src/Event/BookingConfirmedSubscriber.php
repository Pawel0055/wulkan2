<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Exception;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface as SymfonyMailerInterface;
use Symfony\Component\Mime\Email;

class BookingConfirmedSubscriber implements EventSubscriberInterface
{

    public function __construct(private SymfonyMailerInterface $mailer)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            BookingConfirmedEvent::NAME => 'onBookingConfirmed'
        ];
    }

    public function onBookingConfirmed(BookingConfirmedEvent $event)
    {
        return $this->sendEmailMessage(
            'Otrzymałeś nową wiadomość (Dodanie terminu)',
            'test@test.pl',
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