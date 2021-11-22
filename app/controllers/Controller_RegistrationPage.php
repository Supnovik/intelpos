<?php

class Controller_RegistrationPage extends Controller
{
    function actionIndex()
    {
        $this->model = new Model_RegistrationPage();
        $this->view->generate('Registration/registration.php', 'template_view.php');
    }
}
