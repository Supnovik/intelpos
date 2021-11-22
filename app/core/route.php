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
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        switch ('/' . $uri[1]) {
            case '/':

                $controller = new Controller_MainPage;
                $controller->actionIndex();
                break;
            case '/main':
                $controller = new Controller_MainPage;
                $controller->actionIndex();
                break;
            case '/login':
                $controller = new Controller_LoginPage;
                $controller->actionIndex();
                break;
            case '/registration':
                $controller = new Controller_RegistrationPage;
                $controller->actionIndex();
                break;
            case '/list_of_users':
                $controller = new Controller_ListOfUsersPage;
                $controller->actionIndex();
                break;
            case '/users':
                $db = new Model_Database('data', 'users');
                $uri = explode('/', $_SERVER['REQUEST_URI']);
                $flag = false;
                if ($db->checkingForExistence($uri[2]) && !isset($uri[3])) {
                    $flag = true;
                    $controller = new Controller_ProfilePage;
                    $controller->actionIndex();
                }
                if ($db->checkingForExistence($uri[2]) && isset($uri[3]) && isset($uri[4])) {
                    $db = new Model_User($uri[2], $uri[2]);
                    if ($db->checkingSetofcardsForExistence($uri[4]) && $uri[3] == 'setofcards') {
                        $flag = true;
                        $controller = new Controller_SetOfCardsPage();
                        $controller->setData($uri[2], $uri[4]);
                        $controller->actionIndex();
                    } elseif ($db->checkingSetofcardsForExistence($uri[4]) && $uri[3] == 'backdrops') {
                        $flag = true;
                        $controller = new Controller_BackdropsListPage();
                        $controller->setData($uri[2], $uri[4]);
                        $controller->actionIndex();
                    }
                }
                if (!$flag) {
                    echo '<html><body><h1>Page Not Found</h1></body></html>';
                    print_r($uri);
                }

                break;
            default:
                echo '<html><body><h1>Page Not Found</h1></body></html>';
                echo $uri[1];
                break;
        }
    }
}
