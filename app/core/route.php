<?php

include 'app/core/autoloading.php';

global $isLogin;
global $user;

class Route
{

    static function start()
    {
        $GLOBALS['isLogin'] = false;
        if (isset($_COOKIE['user'])) {
            $GLOBALS['isLogin'] = true;
            $GLOBALS['user'] = $_COOKIE['user'];
        }


        $path = ['' => function () {
            $controller = new Controller_MainPage;
            $controller->actionIndex();
        }, 'main' => function () {
            $controller = new Controller_MainPage;
            $controller->actionIndex();
        }, 'login' => function () {
            $controller = new Controller_LoginPage;
            $controller->actionIndex();
        }, 'registration' => function () {
            $controller = new Controller_RegistrationPage;
            $controller->actionIndex();
        }, 'list_of_users' => function () {
            $controller = new Controller_ListOfUsersPage;
            $controller->actionIndex();
        }, 'users' => ['' => function ($user) {
            $db = new Model_Database('data', 'users');
            if ($db->checkingForExistence($user)) {
                $controller = new Controller_ProfilePage;
                $controller->actionIndex();
                return true;
            } else return false;
        }, 'setofcards' => function ($user, $setofcards) {
            $db = new Model_User($user, $user);
            if ($db->checkingSetofcardsForExistence($setofcards)) {
                $controller = new Controller_SetOfCardsPage();
                $controller->setData($user, $setofcards);
                $controller->actionIndex();
                return true;
            } else return false;
        }, 'backdrops' => function ($user, $setofcards) {
            $db = new Model_User($user, $user);
            if ($db->checkingSetofcardsForExistence($setofcards)) {
                $controller = new Controller_BackdropsListPage();
                $controller->setData($user, $setofcards);
                $controller->actionIndex();
                return true;
            } else return false;
        }, 'learn' => function ($user, $setofcards) {
            $db = new Model_User($user, $user);
            if ($db->checkingSetofcardsForExistence($setofcards)) {
                $controller = new Controller_BackdropsListPage();
                $controller->setData($user, $setofcards);
                $controller->actionIndex();
                return true;
            } else return false;
        }]];

        $uri = explode('/', $_SERVER['REQUEST_URI']);
        
        if (array_key_exists($uri[1], $path) && !isset($uri[2])) {
            $func = $path[$uri[1]];
            $func();
        } else {
            if (array_key_exists($uri[1], $path) && isset($uri[2])&& !isset($uri[3])) {
                $func = $path[$uri[1]][''];
                if ($func($uri[2]))
                    return true;
                else
                {
                    echo '<html><body><h1>Page Not Found</h1></body></html>';
                    print_r($uri);
                }
            }
            if (array_key_exists($uri[3], $path[$uri[1]]) && isset($uri[4])) {
                $func = $path[$uri[1]][$uri[3]];
                if ($func($uri[2], $uri[4]))
                    return true;
                else
                {
                    echo '<html><body><h1>Page Not Found</h1></body></html>';
                    print_r($uri);
                }
            } 
            else {
                echo '<html><body><h1>Page Not Found</h1></body></html>';
                print_r($uri);
            }
        }
    }
}