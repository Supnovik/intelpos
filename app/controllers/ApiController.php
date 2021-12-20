<?php

namespace Intelpos\Controller;

use Intelpos\Model;

class ApiController
{
    public function requestResponce()
    {
        $flag = false;
        if (isset($_GET['users'])) {
            $db = new Model\Profile();
            $data = $db->getAllInformationOfUsers();
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