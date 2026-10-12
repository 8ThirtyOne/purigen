<?php

namespace controllers;

use models\Media;
use models\Registration_events;
use models\Video;
use Swift_Message;

class PressController extends BaseController
{
    public function actionIndex()
    {
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/news-events/press/list.php', []);
        exit();
    }

    public function actionView()
    {

        $slug = $GLOBALS['vars']['slug'];
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/news-events/press/view.php', ['slug' => $slug]);
        exit();
    }

    public function actionRedirect()
    {
        $pkId = $_REQUEST['pkid'];
        $slug = Media::find($pkId, ['select' => 'slug'])->to_array();
        $redirect_link = '/news-events/press/' . $slug['slug'];
        header("Location: $redirect_link",TRUE,301);
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

}