<?php

class Controller_ProfilePage extends Controller
{
    function actionIndex()
    {
        $this->model = new Model_ProfilePage();
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $this->view->generate('Profile/profile.php', 'template_view.php', $this->model->getData($uri[2]));
    }
}
