<?php

namespace Intelpos\Model;

use Intelpos\Model;

class Profile extends Model
{
    public function getData($user = null, $data = null)
    {
        $userInfo =$this->getUserInfo($user);
        $db = new DbConstructor();
        $content = $db->getContent(
            'setofcards',
            ['id', 'name'],
            [['type' => 'usersId', 'content' => $userInfo['id']]],
            true
        );

        return $content;
    }
    public function getUserInfo($user){
        $db = new DbConstructor();
        $userInfo = $db->getContent(
            'users',
            ['id', 'nickname'],
            [['type' => 'nickname', 'content' => $user]],
            true
        )[0];
        return $userInfo;
    }

    public function getListofUsers()
    {
        $db = new DbConstructor();

        return $db->getContent('users', ['nickname']);
    }

    public function createSetOfCard($usersId, $set_of_cards_name)
    {
        $db = new DbConstructor();
        $db->addContent('setofcards', [['usersId', $usersId], ['name', $set_of_cards_name]]);
    }

    public function deleteSetOfCard($set_of_cards_id)
    {
        $db = new DbConstructor();
        $db->deleteContent('setofcards', $set_of_cards_id);
    }

    public function deleteUser($user)
    {
        $db = new DbConstructor();
        $db->deleteContent('users', $user);
    }
}
