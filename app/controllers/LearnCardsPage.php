<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class LearnCardsPage extends \Intelpos\Controller
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
        $this->view->generate('LearnCards/learnCards.php', 'template_view.php', $this->model->getData($this->user, $this->setofcards));
    }
}