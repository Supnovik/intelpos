<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class RegistrationPage extends Controller
{

    function actionIndex()
    {
        $this->view = new View();
        $this->view->generate('default');
    }
}
