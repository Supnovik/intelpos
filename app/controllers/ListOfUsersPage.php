<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class ListOfUsersPage extends Controller
{
    function __construct()
    {
        $this->view = new View();
        if (array_key_exists('search-user-button', $_POST)) {
            $db = new Model\database('data', 'users');
            $this->view->generate(
                'ListOfUsers/listOfUsers.php',
                'template_view.php',
                $db->serchUsers(filter_var(trim($_POST['search-user']), FILTER_SANITIZE_STRING))
            );
        }
    }

    function actionIndex()
    {
        $this->model = new Model\listOfUsers();
        $this->view->generate('ListOfUsers/listOfUsers.php', 'template_view.php', $this->model->getData());
    }
}
