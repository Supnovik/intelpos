<?php

namespace Intelpos\Controller;

use Intelpos\Model;

class Authentication
{
    function signOut()
    {
        if (array_key_exists('sign-out', $_POST)) {
            setcookie('user', $GLOBALS['user']['nickname'], time() - 3600, '/');
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    function login($nickname, $password)
    {
        $db = new Model\DbConstructor();
        $len = $db->getContent(
            'users',
            ['nickname'],
            [['type' => 'nickname', 'content' => $nickname], ['type' => 'password', 'content' => $password]],
            true
        );
        print_r($len);
        if ($len != 0) {
            setcookie('user', $nickname, time() + 1200, '/');
            header('Location: /users/'.$nickname);
        }
    }

    function registration($nickname, $mail, $password)
    {
        $db = new Model\DbConstructor();
        $db->addContent('users', [['nickname', $nickname], ['mail', $mail], ['password', $password]]);

        setcookie('user', $nickname, time() + 120, '/');
        header('Location: /users/'.$nickname);
    }
}

if (array_key_exists('sign-out', $_POST)) {
    setcookie('user', $GLOBALS['user']['nickname'], time() - 3600, '/');
    header('Location: '.$_SERVER['HTTP_REFERER']);
}