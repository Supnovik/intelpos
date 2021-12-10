<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;

class HomePage extends Controller
{
    function actionIndex()
    {
        $this->view->generate('Home/home.php', 'default.php');
    }
}
