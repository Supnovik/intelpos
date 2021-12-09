<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;

class RegistrationPage extends Controller
{
    function actionIndex()
    {
        if (array_key_exists('createUser', $_POST)) {
            $nickname = filter_var(trim($_POST['nickname']), FILTER_SANITIZE_STRING);
            $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_STRING);
            $password = md5(filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING).'sol');

            $db = new Model\dbConstructor();
            $db->addContent('users', [['nickname', $nickname], ['mail', $mail], ['password', $password]]);

            setcookie('user', $nickname, time() + 120, '/');
            header('Location: /users/'.$nickname);
        }
        $this->view->generate('Registration/registration.php', 'template_view.php');
    }
}
