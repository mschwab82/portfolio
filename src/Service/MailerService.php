<?php

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public static function sendMail(MailerInterface $mailer)
    {

        $email = new Email();

        $email
            ->from('michael.schwab@outlook.com')
            ->to('michael.schwab@gmx.ch')
            ->subject('Site update just happened!')
            ->text('Someone just updated the site. We told them:');

        $mailer->send($email);
    }
}