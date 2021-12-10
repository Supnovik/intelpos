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
            $db = new Model\DbConstructor();
            $nickname = filter_var(trim($_POST['search-user']), FILTER_SANITIZE_STRING);
            $content = $db->getContent('users', ['nickname'], [['type' => 'nickname', 'content' => $nickname]]);
            $this->view->generate(
                'ListOfUsers/listOfUsers.php',
                'template_view.php',
                $content
            );
        }
    }

    function actionIndex()
    {
        $this->model = new Model\Profile();
        $this->view->generate('ListOfUsers/listOfUsers.php', 'template_view.php', $this->model->getListofUsers());
    }
}
