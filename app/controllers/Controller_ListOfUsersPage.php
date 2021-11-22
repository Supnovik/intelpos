<?php

class Controller_ListOfUsersPage extends Controller
{
    function actionIndex()
    {
        $this->model = new Model_ListOfUsersPage();
        $this->view->generate('ListOfUsers/listOfUsers.php', 'template_view.php', $this->model->getData());
    }
}
