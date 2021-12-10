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
}