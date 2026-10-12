<?php

namespace controllers;

use models\Literature;
use models\Registration_events;
use models\Registration_from_literature;

class BlogController extends BaseController
{
    public function actionIndex()
    {
        $slug = $GLOBALS['vars']['slug'];
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/blogs/list.php', ['slug' => $slug]);
        exit();
    }

    public function actionView()
    {
        $slug = $GLOBALS['vars']['slug'];
        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/blogs/view.php', ['slug' => $slug]);
        exit();
    }
}