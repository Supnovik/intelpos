<?php

namespace Intelpos\Model;

class backdropsList
{
    public function getData($setofcards)
    {
        $db = new dbConstructor();

        return $db->getContent(
            'backdrops',
            ['id', 'setofcardsId', 'name', 'imagePath'],
            [['type' => 'setofcardsId', 'content' => $setofcards['id']]]
        );
    }
}