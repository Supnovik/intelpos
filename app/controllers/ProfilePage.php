<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class ProfilePage extends \Intelpos\Controller
{
    function actionIndex()
    {
        $this->model = new Model\profile();
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $this->view->generate('Profile/profile.php', 'template_view.php', $this->model->getData($uri[2]));
    }
}
