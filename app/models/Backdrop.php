<?php

namespace Intelpos\Model;

use PDOException;

class Backdrop
{
    public $setofcards;
    public $backdrop;

    public function __construct($setofcards, $backdrop)
    {
        $this->setofcards = $setofcards;
        $this->backdrop = $backdrop;
    }

    public function addCard($termin, $definition, $x_coordinate, $y_coordinate)
    {
        $db = new DbConstructor();
        $db->addContent(
            'cardsOnBackdrop',
            [
                ['backdropsId', $this->backdrop['id']],
                ['termin', $termin],
                ['definition', $definition],
                ['x_coordinate', $x_coordinate],
                ['y_coordinate', $y_coordinate],
            ]
        );
    }

    public function getCards()
    {
        $db = new DbConstructor();
        return $db->getContent(
            'cardsOnBackdrop',
            ['id', 'backdropsId', 'termin', 'definition', 'x_coordinate', 'y_coordinate'],
            [['type' => 'backdropsId', 'content' => $this->backdrop['id']]]
        );
    }

    public function changeCardPos($id, $termin, $definition, $x_coordinate, $y_coordinate)
    {
        $db = new DbConstructor();
        $db->updateContent(
            'cardsOnBackdrop',
            $id,
            ['termin', 'definition', 'x_coordinate', 'y_coordinate'],
            [
                'termin' => $termin,
                'definition' => $definition,
                'x_coordinate' => $x_coordinate,
                'y_coordinate' => $y_coordinate,
            ]
        );
    }

    public function removeCard($id)
    {
        $db = new DbConstructor();
        $db->deleteContent('cardsOnBackdrop', $id);
    }

    public function deleteBackdrop()
    {
    }


}