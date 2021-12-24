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
            $pattern = ['id', 'mail', 'nickname', 'password'];
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
        $qw = json_decode(file_get_contents('php://input'), true);
        if (isset($qw['type'])) {
            $flag = true;
            $d = file_get_contents('php://input');
            $data = $qw;
            switch ($qw['type']) {
                case ('delete'):
                    if ($this->delete($qw['content'])) {
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
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header('Content-type: application/json');
        switch ($content['type']) {
            case ('users'):
                if (isset($content['obj']['id'])) {
                    $model = new Model\Profile();
                    $model->deleteUser($content['obj']['id']);

                    return true;
                }
            case ('setOfCards'):
                if (isset($content['obj']['id'])) {
                    $model = new Model\Profile();
                    $model->deleteSetOfCard($content['obj']['id']);

                    return true;
                }
            case ('backdrop'):
                if (isset($content['obj']['id'])) {
                    $model = new Model\BackdropsList();
                    $model->deleteBackdrop($content['obj']['id']);

                    return true;
                }
            case ('cards'):
                if (isset($content['obj']['setOfCardsId'])) {
                    $model = new Model\SetOfCards($content['obj']['setOfCardsId']);
                    $model->deleteCard($content->obj->id);

                    return true;
                }
            case ('cardsOnBackdrop'):
                if (isset($content['obj']['setOfCardsId']) && isset($content['obj']['backdropsId'])) {
                    $model = new Model\Backdrop($content['obj']['setOfCardsId'], $content['obj']['backdropsId']);
                    $model->removeCard($content['obj']['id']);

                    return true;
                }
            case ('comments'):
                if (isset($content['obj']['id'])) {
                    $model = new Model\DbConstructor();
                    $model->deleteContent('comments', $content['obj']['id']);

                    return true;
                }
        }

        return false;
    }

    function edit()
    {
    }
}