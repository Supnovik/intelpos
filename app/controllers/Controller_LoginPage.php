<?php

class Controller_LoginPage extends Controller
{
    function actionIndex()
    {
        $this->model = new Model_LoginPage();
        $this->view->generate('Login/login.php', 'template_view.php');
    }
}
