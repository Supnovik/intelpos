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
    }

    function actionIndex()
    {
        $this->model = new Model\SetOfCards($this->setofcards);
        $this->view->generate(
            'LearnCards/learnCards.php',
            'template_view.php',
            $this->model->getCards($this->setofcards)
        );
    }
}