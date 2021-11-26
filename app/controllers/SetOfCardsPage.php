<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class SetOfCardsPage extends \Intelpos\Controller
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
        $this->model = new Model\setOfCards($this->user, $this->setofcards);
        $this->view->generate('SetOfCards/setofcards.php', 'template_view.php', ['cards'=>$this->model->getData(),'comments'=>$this->model->getComments()]);
    }
}