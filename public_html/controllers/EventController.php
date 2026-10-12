<?php

namespace controllers;

use models\Registration_events;
use Swift_Message;

class EventController extends BaseController
{
    public function actionIndex()
    {

        $slug = $GLOBALS['vars']['slug'];

        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/event/view.php', ['slug' => $slug]);
        exit();
    }

    public function actionRegister()
    {

        $slug = $GLOBALS['vars']['slug'];
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/event/register.php', ['slug' => $slug]);
        exit();
    }

    public function actionSave()
    {
        $webHelper = new \WebHelper();
        if ($webHelper->isSpam($_POST['grecaptchaval'], $_SERVER['REMOTE_ADDR'])) {
            $webHelper->AlertMessageAndHistoryBack('Error(recaptcha). Does not allow access.');
        }
        try {
            $data = $_POST;
            unset($data['grecaptchaval']);
            $regEvent = Registration_events::create($data);
            echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/event/thank_page.php', ['regEvent' => $regEvent]);
            $regEventFull = Registration_events::find($regEvent->pkid);
            $this->sendSalesForce($regEventFull);
            $this->sendEmail($regEventFull);
            exit();
        } catch (\Throwable $e) {
            (new \WebHelper())->AlertMessageAndHistoryBack('Something is wrong!');
        }
    }

    private function sendEmail($regEvent)
    {
        $event = $regEvent->events;
        $isReceive = ($regEvent->isreceive) ? 'yes' : 'no';
        $subject = "Registration: $event->maintitle";
        $content = 'Event: ' . $event->maintitle . "\n" .
            'First Name: ' . $regEvent->firstname . "\n" .
            'Last Name: ' . $regEvent->lastname . "\n" .
            'Email: ' . $regEvent->email . "\n" .
            'Phone: ' . $regEvent->phone . "\n" .
            'Organization / Institution: ' . $regEvent->organization . "\n" .
            'Job Title: ' . $regEvent->job_title . "\n" .
            'State / Province: ' . $regEvent->state . "\n" .
            'Zip: ' . $regEvent->country . "\n" .
            'Main Research: ' . $regEvent->main_application . "\n" .
            'Receive Newsletter: ' . $isReceive . "\n" .
            'Comments: ' . $regEvent->note . "\n";
        $headers = "From: Registration from Web\r\n";

        // Create a message
        $mailListArray = explode( ",", getenv('MAIL_RECIPIENT'));
        $mailBccListArray = explode( ",", getenv('MAIL_BCC'));

        $message = (new Swift_Message($subject))
            ->setFrom([getenv('SMTP_USERNAME') => 'purigenbio.com'])
            ->setTo($mailListArray)
            ->setBcc($mailBccListArray)
            ->setBody($content);

        // Send the message
        $mail = new \lib\Mail();
        return $mail->mailer->send($message);
    }

    private function sendSalesForce($regEvent)
    {
        $event = $regEvent->events;
        $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
        $postData =
            [
                '00N3j00000FB7Jh' =>  'Registration for event',
                'title' => 'Registration for event',
                'first_name' => $regEvent->firstname,
                'last_name' => $regEvent->lastname,
                'email' => $regEvent->email,
                'phone' => $regEvent->phone,
                'company' => $regEvent->organization,
                'member_status' => $regEvent->job_title,
                'state' => $regEvent->state,
                'zip' => $regEvent->country,
                //research type-->
                '00N3j00000EpP37' => '',
                '00N3j00000FAdAy' => $regEvent->main_application,
                '00N3j00000FAUwe' => $regEvent->isreceive,
                '00N3j00000FALvXEAX' => $regEvent->note,
                '00N3j00000FAW61' => $event->maintitle,
                'oid' => '00D3j000000hPGJ'
            ];
        \WebHelper::sendPost($url, $postData);
    }
}