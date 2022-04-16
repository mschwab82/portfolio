<?php



use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail($ip, $browser)
    {
        $email = (new Email())
            ->from('michael.schwab@outlook.com')
            ->to('michael.schwab@gmx.ch')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Webseite wurde besucht')
            ->html(
                'IP = '.$ip.'<br>'.
                // 'Plattform = '.$plattform.'<br>'.
                'Browser = '.$browser
            );

        $this->mailer->send($email);
    }
}