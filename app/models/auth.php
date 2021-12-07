<?php

namespace Intelpos\Model;


if (array_key_exists('sign-out', $_POST)) {
    setcookie('user', $GLOBALS['user']['nickname'], time() - 3600, '/');
    header('Location: '.$_SERVER['HTTP_REFERER']);
}