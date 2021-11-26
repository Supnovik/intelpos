<?php
namespace Intelpos\Controller;
use Intelpos\Model;

class ProfilePage extends \Intelpos\Controller
{
    function actionIndex()
    {
        $this->model = new Model\profile();
        if (array_key_exists('createSetofcards', $_POST)) {

            $this->model->createSetOfCard($GLOBALS['user'], filter_var(trim($_POST['setofcardsName']), FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }

        if (array_key_exists('delete-cardsSet', $_POST)) {
            $this->model->deleteSetOfCard($GLOBALS['user'], filter_var(trim($_POST['setofcardsName']), FILTER_SANITIZE_STRING));
        }

        if (array_key_exists('add-cardsSet', $_POST)) {
            $this->model->createSetOfCard($GLOBALS['user'], filter_var(trim($_POST['setofcardsName']), FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if (array_key_exists('delete-user', $_POST)) {
            $this->model->deleteUser($GLOBALS['user']);
            setcookie('user', $GLOBALS["user"], time() - 3600, '/');
            header('Location: /');
        }
        $this->view->generate('Profile/profile.php', 'template_view.php', $this->model->getData($GLOBALS['uri'][2]));
    }
}
