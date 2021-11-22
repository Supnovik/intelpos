<?php

class Controller_ProfilePage extends Controller
{
    function action_index()
    {
        $this->model = new Model_ProfilePage();
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $this->view->generate('Profile/profile.php', 'template_view.php', $this->model->get_data($uri[2]));
    }
}
