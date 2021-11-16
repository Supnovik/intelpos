<?php
    class Model_RegistrationPage{
        public function __construct(){
            if(array_key_exists('createUser', $_POST)) {
                $nickname = filter_var(trim($_POST['nickname']),FILTER_SANITIZE_STRING);
                $mail = filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING);
                $password = md5(filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING)."sol");
                $databaseOfUsers = new Model_Database('data','users');
                $databaseOfUsers->addUser($nickname,$mail,$password);
                $Usersdatabase = new Model_User($nickname,$nickname);
                $Usersdatabase->createDatabase();
                $Usersdatabase->createTable();
                setcookie('user',$nickname,time()+120,'/');
                header('Location: /users/'.$nickname);
            }
        }
    }