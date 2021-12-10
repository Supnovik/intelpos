<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class RegistrationPage extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        if (array_key_exists('createUser', $_POST)) {
            $nickname = filter_var(trim($_POST['nickname']), FILTER_SANITIZE_STRING);
            $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_STRING);
            $password = md5(filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING).'sol');
            $auth = new Authentication();
            $auth->registration($nickname, $mail, $password);
        }
    }

    function actionIndex()
    {
        $this->view->generate('default');
    }
}
