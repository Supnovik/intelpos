<?php

namespace Intelpos\Model;

use Intelpos\Model;

class Profile extends Model
{
    public function getData($nickname = null, $data = null)
    {
        $userInfo = $this->getUsers($nickname)[0];
        $db = new DbConstructor();
        $content = $db->getContent(
            'setofcards',
            ['id', 'name'],
            [['type' => 'usersId', 'content' => $userInfo['id']]],
            true
        );

        return $content;
    }

    public function getUsers($nickname)
    {
        $db = new DbConstructor();
        $userInfo = $db->getContent(
            'users',
            ['id', 'nickname'],
            [['type' => 'nickname', 'content' => $nickname]],
            true
        );

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
