<?php 
    if(array_key_exists('sign-out', $_POST)) {
            setcookie('user',$GLOBALS["user"],time()-3600,'/');
            print_r($_SERVER['HTTP_REFERER']);
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }