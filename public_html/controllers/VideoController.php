<?php

namespace controllers;

use ActiveRecord\RecordNotFound;
use models\Registration_from_video;
use models\Video;
use Swift_Message;



class VideoController extends BaseController
{
    public function actionIndex()
    {

        $slug = isset($GLOBALS['vars']['slug']) ? $GLOBALS['vars']['slug'] : ''; 
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/video/list.php', ['slug' => $slug]);
    }

    public function actionRedirect()
    {
        $pkId = isset($_REQUEST['pkid']) ? $_REQUEST['pkid'] : "";
        $slug = Video::find($pkId, ['select' => 'slug'])->to_array();
        $redirect_link = '/resources/videos/view/' . $slug['slug'];
        header("Location: $redirect_link",TRUE,301);
    }

    public function actionRegister()
    {
        $slug = isset($GLOBALS['vars']['slug']) ? $GLOBALS['vars']['slug'] : '';
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/video/register.php', ['slug' => $slug]);
    }

    public function actionSave()
    {
        try {
            $webHelper = new \WebHelper();
            if ($webHelper->isSpam($_POST['grecaptchaval'], $_SERVER['REMOTE_ADDR'])) {
                throw new \Exception('Error(recaptcha). Does not allow access.');
            }
            $data = $_POST;
            unset($data['grecaptchaval']);
            unset($data['ClientId']);
            unset($data['lead_source']);
            $regFromVideo = Registration_from_video::create($data);
            $video = Video::find($_POST['video_id']);
            $regFromVideo = Registration_from_video::find($regFromVideo->pkid);
            $this->sendEmail($regFromVideo);
            $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
            $postData =
                [
                    '00N3j00000FB7Jh' => 'Registration: for watching video',
                    'title' => 'Registration: for watching video',
                    'first_name' => $_POST['firstname'],
                    'last_name' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'company' => $_POST['organization'],
                    'state' => $_POST['state'],
                    'lead_source' => $_POST['lead_source'],
                    '00N3j00000FAUwe' => $_POST['isreceive'],
                    '00N3j00000FAW61' => $video->title,
                    'oid' => '00D3j000000hPGJ',
                    //        'ClientId'
                    '00N3j00000FApOt' => $_POST['ClientId']
                ];
            \WebHelper::sendPost($url, $postData);
            echo $this->success(['video_id' => $video->id, 'video_slug' => $video->slug, 'regFromVideo' => $regFromVideo->to_array()], 200);
        } catch (\Throwable $e) {
            echo $this->error($e->getMessage(), 500);
        }
    }

    public function actionView(){
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/video/view.php', ['slug' => $GLOBALS['vars']['slug']]);
    }

    public function actionThankPage(){
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/video/thank-page.php', ['slug' => $_POST['slug'], 'regFromVideo' => $_POST['regFromVideo']]);
    }

    private function sendEmail($regFromVideo)
    {
        $video = $regFromVideo->video;
        $isReceive = ($regFromVideo->isreceive) ? 'yes' : 'no';
        $subject = "Registration: for watching video '$video->title'";
        $content = 'First Name: ' . $regFromVideo->firstname . "<br/>" .
            'Last Name: ' . $regFromVideo->lastname . "<br/>" .
            'Email: ' . $regFromVideo->email . "<br/>" .
            'Phone: ' . $regFromVideo->phone . "<br/>" .
            'Organization / Institution: ' . $regFromVideo->organization . "<br/>" .
            'Job Title: ' . $regFromVideo->job_title . "<br/>" .
            'State / Province: ' . $regFromVideo->state . "<br/>" .
            'Zip: ' . $regFromVideo->country . "<br/>" .
            'Main Research: ' . $regFromVideo->main_application . "<br/>" .
            'Receive Newsletter: ' . $isReceive . "<br/>" .
            'Comments: ' . $regFromVideo->note . "<br/>";

        $mailhelper = new \MailHelper();
        $mailhelper->sendmailToManger($subject, $content, true);
        $mailhelper = null;
    }
}