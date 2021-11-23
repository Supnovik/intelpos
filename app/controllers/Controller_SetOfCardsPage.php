<?php

class Controller_SetOfCardsPage extends Controller
{
    protected $user;
    protected $setofcards;

    function setData($user, $setofcards)
    {
        $this->user = $user;
        $this->setofcards = $setofcards;
    }


    function actionIndex()
    {
        $this->model = new Model_SetOfCards($this->user, $this->setofcards);
        $this->view->generate('SetOfCards/setofcards.php', 'template_view.php', ['cards'=>$this->model->getData(),'comments'=>$this->model->getComments()]);
    }
}