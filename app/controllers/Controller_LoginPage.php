<?php

class Controller_LoginPage extends Controller
{
    function action_index()
    {
        $this->model = new Model_LoginPage();
        $this->view->generate('Login/login.php', 'template_view.php');
    }
}
