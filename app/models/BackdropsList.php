<?php

namespace Intelpos\Model;

class BackdropsList
{
    public function getData($setofcards)
    {
        $db = new DbConstructor();

        return $db->getContent(
            'backdrops',
            ['id', 'setofcardsId', 'name', 'imagePath'],
            [['type' => 'setofcardsId', 'content' => $setofcards['id']]]
        );
    }

    public function deleteBackdrop($backdropId)
    {
        $db = new DbConstructor();
        $db->deleteContent('backdrops', $backdropId);
        $cards = $db->getContent('cardsOnBackdrop', ['id'], [['type' => 'backdropsId', 'content' => $backdropId]]);
        $backdropModel = new Backdrop();
        foreach ($cards as $card) {
            $backdropModel->removeCard($card['id']);
        }
    }
}