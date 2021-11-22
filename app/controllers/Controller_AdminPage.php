<?php


class Controller_AdminPage extends Controller
{
    function actionIndex()
    {
        $this->model = new Model;
        $this->view->generate('Admin/admin.php', 'template_view.php');
    }
}
