<?php

use Intelpos\Model;
use Intelpos\Controller;

include 'app/core/autoloading.php';

global $isLogin;
global $user;
global $uri;
global $title;

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
        $GLOBALS['title'] ='ERROR';
        
        $path = [
            '' => function () {
                $GLOBALS['title'] = 'Main';

                $controller = new Controller\MainPage;
                $controller->actionIndex();
            },
            'login' => function () {
                $GLOBALS['title'] = 'Login';

                $controller = new Controller\LoginPage;
                $controller->actionIndex();
            },
            'registration' => function () {
                $GLOBALS['title'] = 'Registration';

                $controller = new Controller\RegistrationPage;
                $controller->actionIndex();
            },
            'list_of_users' => function () {
                $GLOBALS['title'] = 'List of users';

                $controller = new Controller\ListOfUsersPage;
                $controller->actionIndex();
            },
            'users' => [
                '' => function ($user) {
                    $db = new Model\database('data', 'users');
                    if ($db->checkingForExistence($user)) {
                        $GLOBALS['title'] = $user;

                        $controller = new Controller\ProfilePage;
                        $controller->actionIndex();
                        return true;
                    } else {
                        return false;
                    }
                },
                'setofcards' => [''=>function ($user, $setofcards) {
                    $db = new Model\user($user, $user);
                    if ($db->checkingSetofcardsForExistence($setofcards)) {
                        $GLOBALS['title'] = 'Set of cards';

                        $controller = new Controller\SetOfCardsPage($user, $setofcards);
                        $controller->actionIndex();
                        return true;
                    } else {
                        return false;
                    }
                }],
                'backdropsList' => [''=>function ($user, $setofcards) {
                    $db = new Model\user($user, $user);
                    if ($db->checkingSetofcardsForExistence($setofcards)) {
                        $GLOBALS['title'] = 'Backdrop list';

                        $controller = new Controller\BackdropsListPage($user, $setofcards);
                        $controller->actionIndex();

                        return true;
                    } else {
                        return false;
                    }
                },'backdrop' => function ($user, $setofcards, $backdrop) {
                    if (true) {
                        $GLOBALS['title'] = 'Backdrop';

                        $controller = new Controller\BackdropPage($user, $setofcards, $backdrop);
                        $controller->actionIndex();

                        return true;
                    } else {
                        return false;
                    }
                },],
                'learn' => [''=>function ($user, $setofcards) {
                    $db = new Model\user($user, $user);
                    if ($db->checkingSetofcardsForExistence($setofcards)) {
                        $GLOBALS['title'] = 'Learn';

                        $controller = new Controller\LearnCardsPage($user, $setofcards);
                        $controller->actionIndex();
                        return true;
                    } else {
                        return false;
                    }
                },]
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
                return;

            }
            if (array_key_exists($GLOBALS['uri'][3], $path[$GLOBALS['uri'][1]]) && isset($GLOBALS['uri'][4]) && !isset($GLOBALS['uri'][5])) {
                $func = $path[$GLOBALS['uri'][1]][$GLOBALS['uri'][3]][''];
                if (!$func($GLOBALS['uri'][2], $GLOBALS['uri'][4])) {
                    echo '<html><body><h1>Page Not Found</h1></body></html>';
                    print_r($GLOBALS['uri']);
                }
                return;
            }
            
            if (array_key_exists($GLOBALS['uri'][3], $path[$GLOBALS['uri'][1]])  && isset($GLOBALS['uri'][5])) {
                $func = $path[$GLOBALS['uri'][1]][$GLOBALS['uri'][3]][$GLOBALS['uri'][5]];
                if (!$func($GLOBALS['uri'][2], $GLOBALS['uri'][4], $GLOBALS['uri'][6])) {
                    echo '<html><body><h1>Page Not Found</h1></body></html>';
                    print_r($GLOBALS['uri']);
                }
                return;
            }else {
                echo '<html><body><h1>Page Not Foundd</h1></body></html>';
                print_r($GLOBALS['uri']);
            }
            
        }
    }
}