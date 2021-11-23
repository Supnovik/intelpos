<?php

class Controller_LearnCardsPage extends Controller
{
    public $user;
    public $setofcards;

    function setData($user, $setofcards)
    {
        $this->user = $user;
        $this->setofcards = $setofcards;
    }

    function actionIndex()
    {
        $this->model = new Model_SetOfCards($this->user, $this->setofcards);
        $this->view->generate('LearnCards/learnCards.php', 'template_view.php', $this->model->getData($this->user, $this->setofcards));
    }
}