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
        $this->model = new Model\backdropsList();
        $this->view->generate('BackdropsList/backdropsList.php', 'template_view.php', $this->model->getData($this->user, $this->setofcards));
    }
}