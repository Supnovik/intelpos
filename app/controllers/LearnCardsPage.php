<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class LearnCardsPage extends Controller
{
    public $setofcards;

    function __construct($setofcards)
    {
        $this->setofcards = $setofcards;
        $this->view = new View();
        $this->model = new Model\SetOfCards($this->setofcards);
    }

    function actionIndex()
    {
        $this->view->generate(
            'LearnCards/learnCards.php',
            'default.php',
            $this->model->getCards($this->setofcards)
        );
    }
}