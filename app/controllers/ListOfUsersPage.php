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
        $this->model = new Model\Profile();

        if (array_key_exists('search-user-button', $_POST)) {
            $nickname = filter_var(trim($_POST['search-user']), FILTER_SANITIZE_STRING);
            $content = $this->model->getUsers($nickname);
            $this->view->data = $content;
        }
    }

    function actionIndex()
    {
        $this->view->generate('ListOfUsers/listOfUsers.php', 'default.php', $this->model->getListofUsers());
    }
}
