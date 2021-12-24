<?php

namespace Intelpos\Model;

use PDOException;

class SetOfCards
{
    public function getData($setofcards)
    {
        $cards = $this->getCards($setofcards);
        $comments = $this->getComments($setofcards);

        return ['cards' => $cards, 'comments' => $comments];
    }

    public function getCards($setofcards)
    {
        $db = new DbConstructor();

        return $db->getContent(
            'cards',
            ['id', 'setofcardsId', 'termin', 'definition'],
            [['type' => 'setofcardsId', 'content' => $setofcards['id']]]
        );
    }

    public function getComments($setofcards)
    {
        $db = new DbConstructor();

        return $db->getContent(
            'comments',
            ['id', 'setofcardsId', 'userName', 'comment'],
            [['type' => 'setofcardsId', 'content' => $setofcards['id']]]
        );
    }

    public function addCard($setofcards, $termin, $definition)
    {
        $setofcardsId = $setofcards['id'];
        $db = new DbConstructor();
        $db->addContent('cards', [['setofcardsId', $setofcardsId], ['termin', $termin], ['definition', $definition]]);
    }

    public function addComment($setofcards, $nickname, $comment)
    {
        $setofcardsId = $setofcards['id'];
        $db = new DbConstructor();
        $db->addContent('comments', [['setofcardsId', $setofcardsId], ['userName', $nickname], ['comment', $comment]]);
    }

    public function deleteComment($commentId)
    {
        $db = new DbConstructor();
        $db->deleteContent('comments', $commentId);
    }

    public function sortByAlphabet($setofcards)
    {
        $db = new DbConstructor();
        $sortObj = 'termin';
        $pattern = ['id', 'setofcardsId', 'termin', 'definition'];
        $where = ['type' => 'setofcardsId', 'content' => $setofcards['id']];

        return $db->getSortedContent(
            'cards',
            $pattern,
            $sortObj,
            $where
        );
    }

    public function searchCards($setofcards, $termin)
    {
        $db = new DbConstructor();

        return $db->getContent(
            'cards',
            ['setofcardsId', 'termin', 'definition'],
            [['type' => 'termin', 'content' => $termin], ['type' => 'setofcardsId', 'content' => $setofcards['id']]]
        );
    }

    public function updateCard($id, $pattern, $newValue)
    {
        $db = new DbConstructor();
        $db->updateContent('cards', $id, $pattern, $newValue);
    }

    public function deleteCard($id)
    {
        $db = new DbConstructor();
        $db->deleteContent('cards', $id);
    }

}