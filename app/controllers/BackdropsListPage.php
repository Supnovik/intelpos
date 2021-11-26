<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class BackdropsListPage extends \Intelpos\Controller
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
        if (array_key_exists('createBackdrop', $_POST)) {
            $dbSet = new Model\setOfCards($this->user, $this->setofcards);
            $dbSet->createBackdrop(filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING));
            $dbBack = new Model\backdrop($this->user,filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING));
            $dbBack->createBackdropTable();
        }
        $this->model = new Model\backdropsList();
        $this->view->generate('BackdropsList/backdropsList.php', 'template_view.php', $this->model->getData($this->user, $this->setofcards));
    }
}