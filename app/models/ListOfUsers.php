<?php

namespace Intelpos\Model;

use Intelpos\Model;

class ListOfUsers extends Model
{

    public function getData($user = null, $data = null)
    {
        $db = new DbConstructor();
        return $db->getContent('users',['nickname']);
    }
}