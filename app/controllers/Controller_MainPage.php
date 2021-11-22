<?php

class Controller_MainPage extends Controller
{
    function actionIndex()
    {
        $this->view->generate('Main/main.php', 'template_view.php');
    }
}
