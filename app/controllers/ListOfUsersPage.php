<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class ListOfUsersPage extends \Intelpos\Controller
{
    function actionIndex()
    {
        $this->model = new Model\listOfUsers();
        $this->view->generate('ListOfUsers/listOfUsers.php', 'template_view.php', $this->model->getData());
    }
}
