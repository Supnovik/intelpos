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
            $pattern = ['id', 'setofcardsId', 'userId', 'comment'];

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
        if (isset($_POST['type'])) {
            switch ($_POST['type']) {
                case ('delete'):
                    $this->delete($_POST['content']);
            }
        }
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header('Content-type: application/json');
        if ($flag) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => '404']);
        }
    }

    function delete($content)
    {
        $flag = false;
        switch ($content->type) {
            case ('user'):
                $model = new Model\Profile();
                $model->deleteUser($content->obj->id);
            case ('setOfCards'):
                $model = new Model\Profile();
                $model->deleteSetOfCard($content->obj->id);
            case ('backdrop'):
                $model = new Model\BackdropsList();
                $model->deleteBackdrop($content->obj->id);
            case ('card'):
                $model = new Model\SetOfCards($content->obj->setOfCardsId);
                $model->deleteCard($content->obj->id);
            case ('cardOnBackdrop'):
                $model = new Model\Backdrop($content->obj->setOfCardsId, $content->obj->backdropsId);
                $model->removeCard($content->obj->id);
            case ('comment'):
                $model = new Model\BackdropsList();
                $model->deleteBackdrop($content->obj->id);
        }

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header('Content-type: application/json');
        if ($flag) {
            echo json_encode(['status' => '200']);
        } else {
            echo json_encode(['error' => '404']);
        }
    }

    function edit()
    {
    }
}