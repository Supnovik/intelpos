<?php

namespace Intelpos\Model;

use Intelpos\Model;

class listOfUsers extends Model
{

    public function getData($user = null, $data = null)
    {
        $db = new database('data', 'users');

        return $db->getUsers();
    }
}
