<?php

namespace App\Component\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;

interface MailerInterface
{
    public function sendAddBookingtInformation($email): Email;
}
