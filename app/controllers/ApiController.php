<?php

namespace Intelpos\Controller;

use Intelpos\Model;


class ApiController
{
    private $flag = false;
    private $data = [];
    private $db;

    public function requestResponce()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header('Content-type: application/json');;

        $this->db = new Model\DbConstructor();

        $post = json_decode(file_get_contents('php://input'), true);

        if (count($_GET) != 0) {
            $this->getRequest();
        }
        if ($post) {
            $this->postRequest($post);
        }

        if ($this->flag) {
            echo json_encode($this->data);
        } else {
            echo json_encode(['status' => '404']);
        }
    }

    function getRequest()
    {
        $get = [
            'users' => function () {
                $pattern = ['id', 'mail', 'nickname', 'password', 'hash', 'role'];

                return [
                    'status' => '200',
                    'content' => $this->db->getContent(
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
                    'content' => $this->db->getContent(
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
                    'content' => $this->db->getContent(
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
                    'content' => $this->db->getContent(
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
                    'content' => $this->db->getContent(
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
                    'content' => $this->db->getContent(
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
                        $this->data = $get[$path]();
                        $this->flag = true;
                    }
                }
            }
        }
    }

    function postRequest($post)
    {
        if (isset($post['type'])) {
            switch ($post['type']) {
                case ('delete'):
                    if (!(isset($post['content']) || isset($post['token']))) {
                        return;
                    }
                    if ($this->delete($post['content'], $post['token'])) {
                        $this->flag = true;
                        $this->data = [
                            'status' => '200',
                        ];
                    }

                case ('edit'):
                    if (!(isset($post['content']) || isset($post['token']))) {
                        return;
                    }
                    if ($this->edit($post['content'], $post['token'])) {
                        $this->flag = true;
                        $this->data = [
                            'status' => '200',
                        ];
                    }


                case('isAdmin'):
                    if (!isset($post['content'])) {
                        return;
                    }
                    $isAdmin = $this->isAdmin($post['content']);

                    if ($isAdmin) {
                        $this->flag = true;
                        $this->data = [
                            'status' => '200',
                            'token' => bin2hex($isAdmin),
                        ];
                    }
            }
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
        $users = [];
        if (isset($content['nickname']) && isset($content['password'])) {
            $users =
                $this->db->getContent(
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
        }
        if (count($users) != 0) {
            $token = random_bytes(5);

            $this->db->updateContent('users', $users[0]['id'], ['hash'], ['hash' => bin2hex($token)]);

            return $token;
        }

        return false;
    }

    function tokenIsValid($token)
    {
        $user =
            $this->db->getContent(
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