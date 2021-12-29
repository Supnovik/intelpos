<?php

namespace Intelpos\Controller;

use Intelpos\Model;

class ApiController
{
    public function requestResponce()
    {
        $flag = false;
        if (isset($_GET['users'])) {
            $db = new Model\DbConstructor();
            $pattern = ['id', 'mail', 'nickname', 'password', 'role'];
            $data = [
                'status' => '200',
                'content' => $db->getContent(
                    'users',
                    $pattern
                ),
                'pattern' => $pattern,
            ];
            $flag = true;
        }
        if (isset($_GET['cards'])) {
            $db = new Model\DbConstructor();
            $pattern = ['id', 'termin', 'definition', 'setofcardsId'];

            $data = [
                'status' => '200',
                'content' => $db->getContent(
                    'cards',
                    $pattern
                ),
                'pattern' => $pattern,
            ];
            $flag = true;
        }
        if (isset($_GET['setOfCards'])) {
            $db = new Model\DbConstructor();
            $pattern = ['id', 'name', 'usersId'];

            $data = [
                'status' => '200',
                'content' => $db->getContent(
                    'setofcards',
                    $pattern
                ),
                'pattern' => $pattern,
            ];
            $flag = true;
        }
        if (isset($_GET['backdrops'])) {
            $db = new Model\DbConstructor();
            $pattern = ['id', 'name', 'setofcardsId', 'imagePath'];

            $data = [
                'status' => '200',
                'content' => $db->getContent(
                    'backdrops',
                    $pattern
                ),
                'pattern' => $pattern,
            ];
            $flag = true;
        }
        if (isset($_GET['cardsOnBackdrop'])) {
            $db = new Model\DbConstructor();
            $pattern = ['id', 'termin', 'definition', 'backdropsId', 'x_coordinate', 'y_coordinate'];

            $data = [
                'status' => '200',
                'content' => $db->getContent(
                    'cardsOnBackdrop',
                    $pattern
                ),
                'pattern' => $pattern,
            ];
            $flag = true;
        }
        if (isset($_GET['comments'])) {
            $db = new Model\DbConstructor();
            $pattern = ['id', 'setofcardsId', 'userName', 'comment'];

            $data = [
                'status' => '200',
                'content' => $db->getContent(
                    'comments',
                    $pattern
                ),
                'pattern' => $pattern,
            ];
            $flag = true;
        }
        $post = json_decode(file_get_contents('php://input'), true);
        if (isset($post['type'])) {
            switch ($post['type']) {
                case ('delete'):
                    if ($this->delete($post['content'])) {
                        $flag = true;
                        $data = [
                            'status' => '200',
                        ];
                    }
                case ('edit'):
                    if ($this->edit($post['content'])) {
                        $flag = true;
                        $data = [
                            'status' => '200',
                        ];
                    }
                case('isAdmin'):
                    if ($this->isAdmin($post['content'])) {
                        $flag = true;
                        $data = [
                            'status' => '200',
                        ];
                    }
            }
        }
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header('Content-type: application/json');;
        if ($flag) {
            echo json_encode($data);
        } else {
            echo json_encode(['status' => '404']);
        }
    }

    function delete($content)
    {
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

    function edit($content)
    {
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

        $len = count($db->getContent(
            'users',
            ['nickname'],
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
        ));
        if ($len != 0) {
            return true;
        }

        return false;
    }

}