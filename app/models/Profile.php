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


    public function createSetOfCard($usersId, $setOfCardsName)
    {
        $db = new DbConstructor();
        $db->addContent('setofcards', [['usersId', $usersId], ['name', $setOfCardsName]]);
    }

    public function deleteSetOfCard($setOfCardsId)
    {
        $db = new DbConstructor();
        $db->deleteContent('setofcards', $setOfCardsId);

        $setsCards = $db->getContent('cards', ['id'], [['type' => 'setofcardsId', 'content' => $setOfCardsId]]);
        $setsComments = $db->getContent('comments', ['id'], [['type' => 'setofcardsId', 'content' => $setOfCardsId]]);
        $setOfCardsModel = new SetOfCards();
        foreach ($setsCards as $element) {
            $setOfCardsModel->deleteCard($element['id']);
        }
        foreach ($setsComments as $element) {
            $setOfCardsModel->deleteComment($element['id']);
        }

        $backdropsListModel = new BackdropsList();
        $backdrops = $db->getContent('backdrops', ['id'], [['type' => 'setofcardsId', 'content' => $setOfCardsId]]);
        foreach ($backdrops as $backdrop) {
            $backdropsListModel->deleteBackdrop($backdrop['id']);
        }
    }

    public function deleteUser($userId)
    {
        $db = new DbConstructor();
        $db->deleteContent('users', $userId);
        $setsOfCards = $db->getContent('setofcards', ['id'], [['type' => 'usersId', 'content' => $userId]]);

        foreach ($setsOfCards as $set) {
            $this->deleteSetOfCard($set['id']);
        }
    }
}
