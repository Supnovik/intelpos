<?php

namespace Intelpos\Controller;

use Intelpos\Model;

class Authentication
{

    function processRequest()
    {
        if (array_key_exists('sign-out', $_POST)) {
            $this->signOut();
        }
        if (array_key_exists('login', $_POST)) {
            $nickname = filter_var(trim($_POST['nickname']), FILTER_SANITIZE_STRING);
            $password = md5(filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING).'sol');
            $this->login($nickname, $password);
        }
        if (array_key_exists('createUser', $_POST)) {
            $nickname = filter_var(trim($_POST['nickname']), FILTER_SANITIZE_STRING);
            $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_STRING);
            $password = md5(filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING).'sol');
            $this->registration($nickname, $mail, $password);
        }
    }

    function signOut()
    {
        setcookie('user', $GLOBALS['user']['nickname'], time() - 60 * 60 * 24 * 365, '/');
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    function login($nickname, $password)
    {
        $dbOfUsers = new Model\Profile();
        if (count($dbOfUsers->getUsers($nickname)) == 0) {
            $message = "This user does not exist";
            echo "<script type='text/javascript'> alert('$message');</script>";

            return;
        }

        $db = new Model\DbConstructor();
        $len = $db->getContent(
            'users',
            ['nickname'],
            [['type' => 'nickname', 'content' => $nickname], ['type' => 'password', 'content' => $password]],
            true
        );
        if ($len != 0) {
            setcookie('user', $nickname, time() + 60 * 60 * 24 * 365, '/');
            header('Location: /users/'.$nickname);
        }
    }

    function registration($nickname, $mail, $password)
    {
        $dbOfUsers = new Model\Profile();
        if (count($dbOfUsers->getUsers($nickname)) !== 0) {
            $message = "This is already exists";
            echo "<script type='text/javascript'>alert('$message');</script>";

            return;
        }
        $db = new Model\DbConstructor();
        $db->addContent('users', [['nickname', $nickname], ['mail', $mail], ['password', $password]]);

        setcookie('user', $nickname, time() + 60 * 60 * 24 * 365, '/');
        header('Location: /users/'.$nickname);
    }


}