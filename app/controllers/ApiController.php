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
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header('Content-type: application/json');
        if ($flag) {
            echo json_encode($data);
        } else {
            echo json_encode(['Error' => '404']);
        }
    }
}