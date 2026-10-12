<?php

namespace controllers;

use models\Literature;
use models\Registration_from_literature;
use Swift_Message;

class LiteratureController extends BaseController
{
    public function actionIndex()
    {

        $slug = $GLOBALS['vars']['slug'];

        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/literature/list.php', ['slug' => $slug]);
        exit();
    }

    public function actionRegister()
    {
        $slug = $GLOBALS['vars']['slug'];
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/literature/register.php', ['slug' => $slug]);
        exit();
    }

    public function actionSave()
    {
        try {
            $webHelper = new \WebHelper();
            if ($webHelper->isSpam($_POST['grecaptchaval'], $_SERVER['REMOTE_ADDR'])) {
//                throw new \Exception('Error(recaptcha). Does not allow access.');
            }
            $data = $_POST;
            unset($data['grecaptchaval']);
            unset($data['ClientId']);
//            $webhelper->check_recaptcha($_POST['grecaptchaval'], $_SERVER['REMOTE_ADDR']);
            $regFromLiterature = Registration_from_literature::create($data);
            $literature = Literature::find($_POST['literature_id']);
            $regFromLiterature = Registration_from_literature::find($regFromLiterature->pkid);
            $this->sendEmail($regFromLiterature);
            $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
            $postData =
                [
                    '00N3j00000FB7Jh' =>  'Download file registration',
                    'title' => 'Download file registration',
                    'first_name' => $_POST['firstname'],
                    'last_name' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'company' => $_POST['organization'],
                    'state' => $_POST['state'],
                    '00N3j00000FAUwe' => $_POST['isreceive'],
                    '00N3j00000FAW61' => $literature->title,
                    'oid' => '00D3j000000hPGJ',
                    //        'ClientId'
                    '00N3j00000FApOt' => $_POST['ClientId']
                ];
            \WebHelper::sendPost($url, $postData);
            echo $this->success(['literature_id' => $literature->id, 'regFromLiterature' => $regFromLiterature->to_array()], 200);
        } catch (\Throwable $e) {
            echo $this->error($e->getMessage(), 500);
        }
    }

    public function actionThankPage(){
        $literature = Literature::find($_POST['literature_id']);
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/literature/thank_page.php', ['regFromLiterature' => (object)$_POST['regFromLiterature'], 'literature' => $literature]);
        exit();
    }

    private function sendEmail($regFromLiterature)
    {
        $literature = $regFromLiterature->literature;
        $isReceive = ($regFromLiterature->isreceive) ? 'yes' : 'no';
        $subject = "Registration: for downloading file '$literature->title'";
        $content = 'First Name: ' . $regFromLiterature->firstname . "\n" .
            'Last Name: ' . $regFromLiterature->lastname . "\n" .
            'Email: ' . $regFromLiterature->email . "\n" .
            'Phone: ' . $regFromLiterature->phone . "\n" .
            'Organization / Institution: ' . $regFromLiterature->organization . "\n" .
            'Job Title: ' . $regFromLiterature->job_title . "\n" .
            'State / Province: ' . $regFromLiterature->state . "\n" .
            'Zip: ' . $regFromLiterature->country . "\n" .
            'Main Research: ' . $regFromLiterature->main_application . "\n" .
            'Receive Newsletter: ' . $isReceive . "\n" .
            'Comments: ' . $regFromLiterature->note . "\n";
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
}