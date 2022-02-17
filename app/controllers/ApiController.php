<?php

namespace Intelpos\Controller;

use Intelpos\Model;


class ApiController
{
    public function requestResponce()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header('Content-type: application/json');;

        global $db;
        $db = new Model\DbConstructor();
        $data = [];
        $flag = false;

        $get = [
            'users' => function () {
                $pattern = ['id', 'mail', 'nickname', 'password', 'hash', 'role'];

                return [
                    'status' => '200',
                    'content' => $GLOBALS['db']->getContent(
                        'users',
                        $pattern
                    ),
                    'pattern' => $pattern,
                ];
            },
            'cards' => function () {
                $pattern = ['id', 'termin', 'definition', 'setofcardsId'];

                return [
                    'status' => '200',
                    'content' => $GLOBALS['db']->getContent(
                        'cards',
                        $pattern
                    ),
                    'pattern' => $pattern,
                ];
            },
            'setOfCards' => function () {
                $pattern = ['id', 'name', 'usersId'];

                return [
                    'status' => '200',
                    'content' => $GLOBALS['db']->getContent(
                        'setofcards',
                        $pattern
                    ),
                    'pattern' => $pattern,
                ];
            },
            'backdrops' => function () {
                $pattern = ['id', 'name', 'setofcardsId', 'imagePath'];

                return [
                    'status' => '200',
                    'content' => $GLOBALS['db']->getContent(
                        'backdrops',
                        $pattern
                    ),
                    'pattern' => $pattern,
                ];
            },
            'cardsOnBackdrop' => function () {
                $pattern = ['id', 'termin', 'definition', 'backdropsId', 'x_coordinate', 'y_coordinate'];

                return [
                    'status' => '200',
                    'content' => $GLOBALS['db']->getContent(
                        'cardsOnBackdrop',
                        $pattern
                    ),
                    'pattern' => $pattern,
                ];
            },
            'comments' => function () {
                $pattern = ['id', 'setofcardsId', 'userName', 'comment'];

                return [
                    'status' => '200',
                    'content' => $GLOBALS['db']->getContent(
                        'comments',
                        $pattern
                    ),
                    'pattern' => $pattern,
                ];
            },
        ];
        if (isset($_GET['token'])) {
            if ($this->tokenIsValid($_GET['token'])) {
                foreach (array_keys($get) as $path) {
                    if (isset($_GET[$path])) {
                        $data = $get[$path]();
                        $flag = true;
                    }
                }
            }
        }

        $post = json_decode(file_get_contents('php://input'), true);
        if (isset($post['type'])) {
            switch ($post['type']) {
                case ('delete'):
                    if ($this->delete($post['content'], $post['token'])) {
                        $flag = true;
                        $data = [
                            'status' => '200',
                        ];
                    }
                case ('edit'):
                    if ($this->edit($post['content'], $post['token'])) {
                        $flag = true;
                        $data = [
                            'status' => '200',
                        ];
                    }
                case('isAdmin'):
                    $isAdmin = $this->isAdmin($post['content']);
                    if ($isAdmin) {
                        $flag = true;
                        $data = [
                            'status' => '200',
                            'token' => bin2hex($isAdmin),
                        ];
                    }
            }
        }

        if ($flag) {
            echo json_encode($data);
        } else {
            echo json_encode(['status' => '404']);
        }
    }

    function delete($content, $token)
    {
        if (!$this->tokenIsValid($token)) {
            return false;
        }
        if (isset($content['obj']['id'])) {
            switch ($content['table']) {
                case ('users'):
                    $model = new Model\Profile();
                    $model->deleteUser($content['obj']['id']);

                    return true;

                case ('setOfCards'):
                    $model = new Model\Profile();
                    $model->deleteSetOfCard($content['obj']['id']);

                    return true;

                case ('backdrop'):
                    $model = new Model\BackdropsList();
                    $model->deleteBackdrop($content['obj']['id']);

                    return true;

                case ('cards'):
                    $model = new Model\SetOfCards();
                    $model->deleteCard($content['obj']['id']);

                    return true;

                case ('cardsOnBackdrop'):
                    $model = new Model\Backdrop();
                    $model->removeCard($content['obj']['id']);

                    return true;

                case ('comments'):
                    $model = new Model\DbConstructor();
                    $model->deleteContent('comments', $content['obj']['id']);

                    return true;
            }
        }

        return false;
    }

    function edit($content, $token)
    {
        if (!$this->tokenIsValid($token)) {
            return false;
        }
        if (isset($content['table']) && isset($content['obj']['id'])) {
            $db = new Model\DbConstructor();
            $pattern = array_keys($content['obj']);
            $db->updateContent($content['table'], $content['obj']['id'], $pattern, $content['obj']);

            return true;
        }

        return false;
    }

    function isAdmin($content)
    {
        $db = new Model\DbConstructor();

        $user =
            $db->getContent(
                'users',
                ['id', 'nickname'],
                [
                    [
                        'type' => 'nickname',
                        'content' => $content['nickname'],
                    ],
                    [
                        'type' => 'password',
                        'content' => $content['password'],
                    ],
                    [
                        'type' => 'role',
                        'content' => 'admin',
                    ],
                ],
                true
            );
        if (count($user) != 0) {
            $token = random_bytes(5);

            $db->updateContent('users', $user[0]['id'], ['hash'], ['hash' => bin2hex($token)]);

            return $token;
        }

        return false;
    }

    function tokenIsValid($token)
    {
        $db = new Model\DbConstructor();
        $user =
            $db->getContent(
                'users',
                ['hash'],
                [
                    [
                        'type' => 'hash',
                        'content' => $token,
                    ],
                ],
                true
            );
        if (count($user) != 0) {
            return true;
        } else {
            return false;
        }
    }
}