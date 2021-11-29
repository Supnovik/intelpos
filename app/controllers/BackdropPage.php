<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class BackdropPage extends Controller
{
    public $user;
    public $backdrop;
    public $setofcards;

    function __construct($user, $setofcards, $backdrop)
    {
        $this->user = $user;
        $this->backdrop = $backdrop;
        $this->setofcards = $setofcards;
        $this->model = new Model\backdrop($this->user, $this->backdrop);
        $this->view = new View();

        if (array_key_exists('backdrop-addCard',$_POST)){
            $this->model->addCard(filter_var(trim($_POST['backdrop-card']), FILTER_SANITIZE_STRING),'Def','100','100');
        }
    }

    function actionIndex()
    {
        $setOfCards = new Model\setOfCards($this->user,$this->setofcards);
        $this->view->generate(
            'Backdrop/backdrop.php',
            'template_view.php',
            ['allCards' => $setOfCards->getCards(),'backdropCards' => $this->model->getCards()]
        );
    }
}