<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class BackdropsListPage extends Controller
{
    public $user;
    public $setofcards;

    function __construct($user, $setofcards)
    {
        $this->user = $user;
        $this->setofcards = $setofcards;
        $this->view = new View();

        if (isset($_FILES['file'])) {
            $check = $this->can_upload($_FILES['file']);
            if ($check === true) {
                $this->make_upload($_FILES['file']);
            } else {
                echo $check;
            }
        }
        if (array_key_exists('delete-backdrop',$_POST)) {
            $dbSet = new Model\setOfCards($this->user, $this->setofcards);
            $dbSet->deleteBackdrop(filter_var(trim($_POST['backdropName']), FILTER_SANITIZE_STRING));
            $dbBack = new Model\backdrop($this->user, filter_var(trim($_POST['backdropName']), FILTER_SANITIZE_STRING));
            $dbBack->deleteBackdrop();
        }
    }

    function actionIndex()
    {
        if (array_key_exists('createBackdrop', $_POST)) {
        }
        $this->model = new Model\backdropsList();
        $this->view->generate(
            'BackdropsList/backdropsList.php',
            'template_view.php',
            $this->model->getData($this->user, $this->setofcards)
        );
    }

    function can_upload($file)
    {
        if ($file['size'] == 0) {
            return 'The file is too large.';
        }
        $getMime = explode('.', $file['name']);
        $mime = strtolower(end($getMime));
        $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
        if (!in_array($mime, $types)) {
            return 'Invalid file type.';
        }

        return true;
    }

    function make_upload($file)
    {
        $backdropName = filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING);
        $name = $backdropName.$file['name'];
        copy($file['tmp_name'], "backdropsImg/$name");
        $dbSet = new Model\setOfCards($this->user, $this->setofcards);
        $dbSet->createBackdrop($backdropName, 'backdropsImg/'.$name);
        $dbBack = new Model\backdrop($this->user, $backdropName);
        $dbBack->createBackdropTable();
    }
}