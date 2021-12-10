<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class BackdropsListPage extends Controller
{
    public $user;
    public $setofcards;

    function __construct($setofcards)
    {
        $this->setofcards = $setofcards;
        $this->model = new Model\BackdropsList();
        $this->view = new View();

        if (isset($_FILES['file'])) {
            $check = $this->can_upload($_FILES['file']);
            if ($check === true) {
                $this->make_upload($_FILES['file']);
            } else {
                echo $check;
            }
        }
        if (array_key_exists('delete-backdrop', $_POST)) {
            unlink(filter_var(trim($_POST['imagePath']), FILTER_SANITIZE_STRING));
            $this->model->deleteBackdrop(filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING));
        }
    }

    function actionIndex()
    {
        $this->view->generate(
            'BackdropsList/backdropsList.php',
            'template_view.php',
            $this->model->getData($this->setofcards)
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
        $getMime = explode('.', $file['name']);
        $mime = strtolower(end($getMime));
        $name = $backdropName.'.'.$mime;
        copy($file['tmp_name'], "backdropsImg/$name");

        $db = new Model\DbConstructor();
        $db->addContent(
            'backdrops',
            [['setofcardsId', $this->setofcards['id']], ['name', $backdropName], ['imagePath', 'backdropsImg/'.$name]]
        );
    }
}