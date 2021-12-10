<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;

class ProfilePage extends Controller
{
    public function __construct()
    {
        $this->view = new \Intelpos\View();
        $this->model = new Model\Profile();

        $isOwner = false;
        if ($GLOBALS['uri'][2] == $GLOBALS['user']) {
            $isOwner = true;
        } else {
            $isOwner = false;
        }
        if (array_key_exists('createSetofcards', $_POST) && $isOwner) {
            $this->model->createSetOfCard(
                $GLOBALS['user']['id'],
                filter_var(trim($_POST['setofcardsName']), FILTER_SANITIZE_STRING)
            );
            echo "<meta http-equiv='refresh' content='0'>";
        }

        if (array_key_exists('delete-cardsSet', $_POST) && $isOwner) {
            $this->model->deleteSetOfCard(filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING));
        }

        if (array_key_exists('add-cardsSet', $_POST) && $isOwner) {
            $this->model->createSetOfCard(
                $GLOBALS['user']['id'],
                filter_var(trim($_POST['setofcardsName']), FILTER_SANITIZE_STRING)
            );
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if (array_key_exists('delete-user', $_POST) && $isOwner) {
            $this->model->deleteUser($GLOBALS['user']['id']);
            setcookie('user', $GLOBALS['user']['nickname'], time() - 3600, '/');
            header('Location: /');
        }
    }

    function actionIndex()
    {
        $userNickname = $GLOBALS['uri'][2];
        $this->view->generate('Profile/profile.php', 'template_view.php', $this->model->getData($userNickname));
    }
}
