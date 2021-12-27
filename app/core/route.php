<?php

use Intelpos\Model;
use Intelpos\Controller;

include 'app/core/autoloading.php';

global $isLogin;
global $user;
global $uri;
global $title;


function Error_404()
{
    $GLOBALS['title'] = 'Error404';
    http_response_code(404);
    echo '<html><body><h1>Page Not Found</h1></body></html>';
    die();
}

class Route
{

    static function start()
    {
        $GLOBALS['uri'] = explode('/', $_SERVER['REQUEST_URI']);
        foreach ($GLOBALS['uri'] as &$uri) {
            if (strripos($uri, '?')) {
                $uri = mb_substr($uri, 0, strripos($uri, '?'));
            }
        }
        $GLOBALS['isLogin'] = false;
        if (isset($_COOKIE['user'])) {
            $GLOBALS['isLogin'] = true;
            $db = new Model\DbConstructor();
            $GLOBALS['user'] = $db->getContent(
                'users',
                ['id', 'nickname'],
                [['type' => 'nickname', 'content' => $_COOKIE['user']]],
                true
            )[0];
        }
        $GLOBALS['title'] = 'ERROR';

        $path = [
            '' => function () {
                $GLOBALS['title'] = 'Home';
                $controller = new Controller\HomePage;
                $controller->actionIndex();
            },
            'admin' => function () {
                header('Location: http://159.223.167.52:8080/');
            },
            'api' => function () {
                $GLOBALS['title'] = 'api';
                $controller = new Controller\ApiController;
                $controller->requestResponce();
            },
            'login' => function () {
                $GLOBALS['title'] = 'Login';
                $controller = new Controller\LoginPage;
                $controller->actionIndex();
            },
            'authorization' => function () {
                $controller = new Controller\Authentication();
                $controller->processRequest();
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
                '' => function ($nickname) {
                    $db = new Model\DbConstructor();
                    $len = count(
                        $db->getContent('users', ['nickname'], [['type' => 'nickname', 'content' => $nickname]], true)
                    );

                    if ($len !== 0) {
                        $GLOBALS['title'] = $nickname;

                        $controller = new Controller\ProfilePage;
                        $controller->actionIndex();

                        return true;
                    } else {
                        return false;
                    }
                },
                'setofcards' => [
                    '' => function ($userNickname, $setofcardsId) {
                        $db = new Model\DbConstructor();
                        $setofcards = $db->getContent(
                            'setofcards',
                            ['id', 'name'],
                            [['type' => 'id', 'content' => $setofcardsId]],
                            true
                        )[0];
                        if (count($setofcards) !== 0) {
                            $GLOBALS['title'] = 'Set of cards';
                            $controller = new Controller\SetOfCardsPage($userNickname, $setofcards);
                            $controller->actionIndex();

                            return true;
                        } else {
                            return false;
                        }
                    },
                ],
                'backdropsList' => [
                    '' => function ($userNickname, $setofcardsId) {
                        $db = new Model\DbConstructor();
                        $setofcards = $db->getContent(
                            'setofcards',
                            ['id', 'name'],
                            [['type' => 'id', 'content' => $setofcardsId]],
                            true
                        )[0];
                        if (count($setofcards) !== 0) {
                            $GLOBALS['title'] = 'Backdrop list';

                            $controller = new Controller\BackdropsListPage($setofcards);
                            $controller->actionIndex();

                            return true;
                        } else {
                            return false;
                        }
                    },
                    'backdrop' => function ($userNickname, $setofcardsId, $backdropId) {
                        $db = new Model\DbConstructor();
                        $setofcards = $db->getContent(
                            'setofcards',
                            ['id', 'name'],
                            [['type' => 'id', 'content' => $setofcardsId]],
                            true
                        )[0];
                        $backdrop = $db->getContent(
                            'backdrops',
                            ['id', 'name', 'imagePath'],
                            [
                                ['type' => 'id', 'content' => $backdropId],
                                ['type' => 'setofcardsId', 'content' => $setofcards['id']],
                            ],
                            true
                        )[0];
                        if (count($backdrop) !== 0) {
                            $GLOBALS['title'] = 'Backdrop';
                            $controller = new Controller\BackdropPage($userNickname, $setofcards, $backdrop);
                            $controller->actionIndex();

                            return true;
                        } else {
                            return false;
                        }
                    },
                ],
                'learn' => [
                    '' => function ($userNickname, $setofcardsId) {
                        $db = new Model\DbConstructor();
                        $setofcards = $db->getContent(
                            'setofcards',
                            ['id', 'name'],
                            [['type' => 'id', 'content' => $setofcardsId]],
                            true
                        )[0];
                        if (count($setofcards) !== 0) {
                            $GLOBALS['title'] = 'Learn';
                            $controller = new Controller\LearnCardsPage($setofcards);
                            $controller->actionIndex();

                            return true;
                        } else {
                            return false;
                        }
                    },
                ],

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
                    Error_404();
                }

                return;
            }
            if (array_key_exists(
                    $GLOBALS['uri'][3],
                    $path[$GLOBALS['uri'][1]]
                ) && isset($GLOBALS['uri'][4]) && !isset($GLOBALS['uri'][5])) {
                $func = $path[$GLOBALS['uri'][1]][$GLOBALS['uri'][3]][''];
                if (!$func($GLOBALS['uri'][2], $GLOBALS['uri'][4])) {
                    Error_404();
                }

                return;
            }

            if (array_key_exists($GLOBALS['uri'][3], $path[$GLOBALS['uri'][1]]) && isset($GLOBALS['uri'][5])) {
                $func = $path[$GLOBALS['uri'][1]][$GLOBALS['uri'][3]][$GLOBALS['uri'][5]];
                if (!$func($GLOBALS['uri'][2], $GLOBALS['uri'][4], $GLOBALS['uri'][6])) {
                    Error_404();
                }

                return;
            }
            Error_404();
        }
    }
}
