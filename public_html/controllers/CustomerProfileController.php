<?php

namespace controllers;

use models\CustomerProfile;
use models\Registration_events;
use models\Registration_from_literature;

class CustomerProfileController extends BaseController
{
    public function actionIndex()
    {
        $slug = $GLOBALS['vars']['slug'];
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/customer-profiles/list.php', ['slug' => $slug]);
        exit();
    }

    public function actionView()
    {
        $slug = $GLOBALS['vars']['slug'];
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/customer-profiles/view.php', ['slug' => $slug]);
        exit();
    }
}