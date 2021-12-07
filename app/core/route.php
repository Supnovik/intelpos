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
    echo '<html><body><h1>Page Not Foundd</h1></body></html>';
}

class Route
{

    static function start()
    {
        $GLOBALS['uri'] = explode('/', $_SERVER['REQUEST_URI']);
        $GLOBALS['isLogin'] = false;
        if (isset($_COOKIE['user'])) {
            $GLOBALS['isLogin'] = true;
            $db =  new Model\dbConstructor();
            $GLOBALS['user'] =  $db->getContent('users',['id','nickname'],[['type'=>'nickname','content'=>$_COOKIE['user']]],true)[0];
        }
        $GLOBALS['title'] = 'ERROR';
        
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
                '' => function ($nickname) {
                    $db = new Model\dbConstructor();
                    $len = $db->getContent('users',['nickname'],[['type'=>'nickname','content'=>$nickname]],true);
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
                    '' => function ($user, $setofcards) {
                        $db = new Model\dbConstructor();
                        $setofcards = $db->getContent('setofcards',['id','name'],[['type'=>'name','content'=>$setofcards]],true)[0];
                        if (count($setofcards) !== 0) {
                            $GLOBALS['title'] = 'Set of cards';
                            $controller = new Controller\SetOfCardsPage($user, $setofcards);
                            $controller->actionIndex();
                            return true;
                        } else {
                            return false;
                        }
                    },
                ],
                'backdropsList' => [
                    '' => function ($user, $setofcards) {
                        $db = new Model\dbConstructor();
                        $setofcards = $db->getContent('setofcards',['id','name'],[['type'=>'name','content'=>$setofcards]],true)[0];
                        if (count($setofcards) !== 0) {
                            $GLOBALS['title'] = 'Backdrop list';

                            $controller = new Controller\BackdropsListPage($setofcards);
                            $controller->actionIndex();

                            return true;
                        } else {
                            return false;
                        }
                    },
                    'backdrop' => function ($user, $setofcards, $backdrop) {
                        $db = new Model\dbConstructor();
                        $setofcards = $db->getContent('setofcards',['id','name'],[['type'=>'name','content'=>$setofcards]],true)[0];
                        $backdrop = $db->getContent('backdrops',['id','name','imagePath'],[['type'=>'name','content'=>$backdrop],['type'=>'setofcardsId','content'=>$setofcards['id']]],true)[0];
                        if (count($backdrop) !== 0) {
                            $GLOBALS['title'] = 'Backdrop';
                            $controller = new Controller\BackdropPage($user, $setofcards, $backdrop);
                            $controller->actionIndex();

                            return true;
                        } else {
                            return false;
                        }
                    },
                ],
                'learn' => [
                    '' => function ($user, $setofcards) {
                        $db = new Model\dbConstructor();
                        $setofcards = $db->getContent('setofcards',['id','name'],[['type'=>'name','content'=>$setofcards]],true)[0];
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
                    return;
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
                    return;

                }

                return;
            }

            if (array_key_exists($GLOBALS['uri'][3], $path[$GLOBALS['uri'][1]]) && isset($GLOBALS['uri'][5])) {
                $func = $path[$GLOBALS['uri'][1]][$GLOBALS['uri'][3]][$GLOBALS['uri'][5]];
                if (!$func($GLOBALS['uri'][2], $GLOBALS['uri'][4], $GLOBALS['uri'][6])) {
                    Error_404();
                    return;

                }
                return;
            } else {
                Error_404();
            }
        }
    }
}
