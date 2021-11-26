<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class LearnCardsPage extends Controller
{
    public $user;
    public $setofcards;

    function __construct($user, $setofcards)
    {
        $this->user = $user;
        $this->setofcards = $setofcards;
        $this->view = new View();
    }

    function actionIndex()
    {
        $this->model = new Model\setOfCards($this->user, $this->setofcards);
        $this->view->generate(
            'LearnCards/learnCards.php',
            'template_view.php',
            $this->model->getData($this->user, $this->setofcards)
        );
    }
}