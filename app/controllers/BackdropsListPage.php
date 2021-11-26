<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class BackdropsListPage extends Controller
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
        if (array_key_exists('createBackdrop', $_POST)) {
            $dbSet = new Model\setOfCards($this->user, $this->setofcards);
            $dbSet->createBackdrop(filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING));
            $dbBack = new Model\backdrop($this->user, filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING));
            $dbBack->createBackdropTable();
        }
        $this->model = new Model\backdropsList();
        $this->view->generate(
            'BackdropsList/backdropsList.php',
            'template_view.php',
            $this->model->getData($this->user, $this->setofcards)
        );
    }
}