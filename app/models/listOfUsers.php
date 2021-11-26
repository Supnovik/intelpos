<?php
namespace Intelpos\Model;

class listOfUsers extends \Intelpos\Model
{

    public function getData($user = null, $data = null)
    {
        $db = new database('data', 'users');
        return $db->getUsers();
    }
}
