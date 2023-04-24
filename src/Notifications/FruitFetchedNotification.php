<?php

namespace App\Notifications;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class FruitFetchedNotification
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendNotificationEmail(): void
    {
        $email = (new Email())
            ->from('sirmartins@gmail.com')
            ->to('spacehubt@gmail.com')
            ->subject('Fruit Import Notification')
            ->text('All fruits have been imported successfully.');


        $this->mailer->send($email);
    }
}