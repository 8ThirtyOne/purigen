<?php

namespace lib;

class Mail
{
    public $mailer;

    public function __construct()
    {
        $transport = (new \Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT')))
            ->setUsername(getenv('SMTP_USERNAME'))
            ->setPassword(getenv('SMTP_PASSWORD'))
        ;
        $this->mailer = new \Swift_Mailer($transport);
    }
}