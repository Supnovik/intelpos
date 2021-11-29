<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;

class LoginPage extends Controller
{

    function actionIndex()
    {
        if (array_key_exists('login', $_POST)) {
            $nickname = filter_var(trim($_POST['nickname']), FILTER_SANITIZE_STRING);
            $password = md5(filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING).'sol');
            $db = new Model\database('data', 'users');
            if ($db->checkingForExistence($nickname, $password)) {
                setcookie('user', $nickname, time() + 1200, '/');
                header('Location: /users/'.$nickname);
            }
        }
        $this->view->generate('Login/login.php', 'template_view.php');
    }
}