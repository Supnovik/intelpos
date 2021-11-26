<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class RegistrationPage extends \Intelpos\Controller
{
    function actionIndex()
    {
        $this->model = new Model\registration();
        $this->view->generate('Registration/registration.php', 'template_view.php');
    }
}
