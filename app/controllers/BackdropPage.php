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

        if (array_key_exists('addCardToBackdrop',$_POST)){
            $termin = filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING);
            $definition = filter_var(trim($_POST['definition']), FILTER_SANITIZE_STRING);
            $x_coordinate = filter_var(trim($_POST['x_coordinate']), FILTER_SANITIZE_STRING);
            $y_coordinate = filter_var(trim($_POST['y_coordinate']), FILTER_SANITIZE_STRING);
            $this->model->addCard($termin,$definition,$x_coordinate,$y_coordinate);
        }
        if (array_key_exists('changeCardPos',$_POST)){
            $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
            $termin = filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING);
            $definition = filter_var(trim($_POST['definition']), FILTER_SANITIZE_STRING);
            $x_coordinate = filter_var(trim($_POST['x_coordinate']), FILTER_SANITIZE_STRING);
            $y_coordinate = filter_var(trim($_POST['y_coordinate']), FILTER_SANITIZE_STRING);
            $this->model->changeCardPos($id,$termin,$definition,$x_coordinate,$y_coordinate);
        }
    }

    function actionIndex()
    {
        $setOfCards = new Model\setOfCards($this->user,$this->setofcards);
        $this->view->generate(
            'Backdrop/backdrop.php',
            'template_view.php',
            ['allCards' => $setOfCards->getCards(),'backdropCards' => $this->model->getCards(),'imagePath' => $setOfCards->getBackdropImage($this->backdrop)]
        );
    }
}