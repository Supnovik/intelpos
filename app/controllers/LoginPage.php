<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class LoginPage extends \Intelpos\Controller
{
    function actionIndex()
    {
        $this->model = new Model\login();
        $this->view->generate('Login/login.php', 'template_view.php');
    }
}
