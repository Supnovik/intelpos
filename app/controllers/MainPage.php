<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;

class MainPage extends Controller
{
    function actionIndex()
    {
        $this->view->generate('Main/main.php', 'template_view.php');
    }
}
