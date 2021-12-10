<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;

class LoginPage extends Controller
{
    public function __construct()
    {
        $this->view = new \Intelpos\View();
        if (array_key_exists('login', $_POST)) {
            $nickname = filter_var(trim($_POST['nickname']), FILTER_SANITIZE_STRING);
            $password = md5(filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING).'sol');
            $auth = new Authentication();
            $auth->login($nickname, $password);
        }
    }

    function actionIndex()
    {
        $this->view->generate('Login/login.php', 'template_view.php');
    }
}
