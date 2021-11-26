<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class MainPage extends \Intelpos\Controller
{
    function actionIndex()
    {
        $this->view->generate('Main/main.php', 'template_view.php');
    }
}
