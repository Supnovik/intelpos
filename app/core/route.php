<?php

use Intelpos\Model;
use Intelpos\Controller;

include 'app/core/autoloading.php';

global $isLogin;
global $user;
global $uri;

class Route
{

    static function start()
    {
        $GLOBALS['uri'] = explode('/', $_SERVER['REQUEST_URI']);
        $GLOBALS['isLogin'] = false;
        if (isset($_COOKIE['user'])) {
            $GLOBALS['isLogin'] = true;
            $GLOBALS['user'] = $_COOKIE['user'];
        }


        $path = [
            '' => function () {
                $controller = new Controller\MainPage;
                $controller->actionIndex();
            },
            'main' => function () {
                $controller = new Controller\MainPage;
                $controller->actionIndex();
            },
            'login' => function () {
                $controller = new Controller\LoginPage;
                $controller->actionIndex();
            },
            'registration' => function () {
                $controller = new Controller\RegistrationPage;
                $controller->actionIndex();
            },
            'list_of_users' => function () {
                $controller = new Controller\ListOfUsersPage;
                $controller->actionIndex();
            },
            'users' => [
                '' => function ($user) {
                    $db = new Model\database('data', 'users');
                    if ($db->checkingForExistence($user)) {
                        $controller = new Controller\ProfilePage;
                        $controller->actionIndex();

                        return true;
                    } else {
                        return false;
                    }
                },
                'setofcards' => function ($user, $setofcards) {
                    $db = new Model\user($user, $user);
                    if ($db->checkingSetofcardsForExistence($setofcards)) {
                        $controller = new Controller\SetOfCardsPage($user, $setofcards);
                        $controller->actionIndex();

                        return true;
                    } else {
                        return false;
                    }
                },
                'backdrops' => function ($user, $setofcards) {
                    $db = new Model\user($user, $user);
                    if ($db->checkingSetofcardsForExistence($setofcards)) {
                        $controller = new Controller\BackdropsListPage();
                        $controller->setData($user, $setofcards);
                        $controller->actionIndex();

                        return true;
                    } else {
                        return false;
                    }
                },
                'learn' => function ($user, $setofcards) {
                    $db = new Model\user($user, $user);
                    if ($db->checkingSetofcardsForExistence($setofcards)) {
                        $controller = new Controller\LearnCardsPage();
                        $controller->setData($user, $setofcards);
                        $controller->actionIndex();

                        return true;
                    } else {
                        return false;
                    }
                },
            ],
        ];


        if (array_key_exists($GLOBALS['uri'][1], $path) && !isset($GLOBALS['uri'][2])) {
            $func = $path[$GLOBALS['uri'][1]];
            $func();
        } else {
            if (array_key_exists(
                    $GLOBALS['uri'][1],
                    $path
                ) && isset($GLOBALS['uri'][2]) && !isset($GLOBALS['uri'][3])) {
                $func = $path[$GLOBALS['uri'][1]][''];
                if (!$func($GLOBALS['uri'][2])) {
                    echo '<html><body><h1>Page Not Found</h1></body></html>';
                    print_r($GLOBALS['uri']);
                }
            }
            if (array_key_exists($GLOBALS['uri'][3], $path[$GLOBALS['uri'][1]]) && isset($GLOBALS['uri'][4])) {
                $func = $path[$GLOBALS['uri'][1]][$GLOBALS['uri'][3]];
                if (!$func($GLOBALS['uri'][2], $GLOBALS['uri'][4])) {
                    echo '<html><body><h1>Page Not Found</h1></body></html>';
                    print_r($GLOBALS['uri']);
                }
            } else {
                echo '<html><body><h1>Page Not Found</h1></body></html>';
                print_r($GLOBALS['uri']);
            }
        }
    }
}