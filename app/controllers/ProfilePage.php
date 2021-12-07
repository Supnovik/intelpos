<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;

class ProfilePage extends Controller
{
    function actionIndex()
    {
        $this->model = new Model\profile();
        $db = new Model\dbConstructor();
        $getId = $db->getContent('users',['id','nickname'],[['type'=>'nickname','content'=>$GLOBALS['uri'][2]]],true)[0];
        if (array_key_exists('createSetofcards', $_POST)) {
            $this->model->createSetOfCard(
                $GLOBALS['user']['id'],
                filter_var(trim($_POST['setofcardsName']), FILTER_SANITIZE_STRING)
            );
            echo "<meta http-equiv='refresh' content='0'>";
        }

        if (array_key_exists('delete-cardsSet', $_POST)) {
            $this->model->deleteSetOfCard(filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING));
        }

        if (array_key_exists('add-cardsSet', $_POST)) {
            $this->model->createSetOfCard(
                $GLOBALS['user']['id'],
                filter_var(trim($_POST['setofcardsName']), FILTER_SANITIZE_STRING)
            );
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if (array_key_exists('delete-user', $_POST)) {
            $this->model->deleteUser($GLOBALS['user']['id']);
            setcookie('user', $GLOBALS['user']['nickname'], time() - 3600, '/');
            header('Location: /');
        }
        $this->view->generate('Profile/profile.php', 'template_view.php', $this->model->getData($getId));
    }
}
