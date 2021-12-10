<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class SetOfCardsPage extends Controller
{
    public $user;
    public $setofcards;

    function __construct($userNickname, $setofcards)
    {
        $this->user = $userNickname;
        $this->setofcards = $setofcards;

        $this->view = new View();
        $this->model = new Model\SetOfCards($this->setofcards);
        if (array_key_exists('create-card', $_POST)) {
            $this->model->addCard(
                filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING),
                filter_var(trim($_POST['definition']), FILTER_SANITIZE_STRING)
            );
        }
        if (array_key_exists('save-card', $_POST)) {
            $pattern = ['termin', 'definition'];
            $newValue = [
                'termin' => filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING),
                'definition' => filter_var(trim($_POST['definition']), FILTER_SANITIZE_STRING),
            ];
            $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
            $this->model->updateCard($id, $pattern, $newValue);
        }
        if (array_key_exists('delete-card', $_POST)) {
            $this->model->deleteCard(filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING));
        }

        if (array_key_exists('search-card-button', $_POST)) {
            $this->view->generate(
                'SetOfCards/setofcards.php',
                'default.php',
                [
                    'cards' => $this->model->searchCards(
                        $setofcards['id'],
                        filter_var(trim($_POST['search-card']), FILTER_SANITIZE_STRING)
                    ),
                    'comments' => $this->model->getComments(),
                ]
            );
        }

        if (array_key_exists('sortByAlphabet', $_POST)) {
            $this->view->generate(
                'SetOfCards/setofcards.php',
                'default.php',
                ['cards' => $this->model->sortByAlphabet(), 'comments' => $this->model->getComments()]
            );
        }

        if (array_key_exists('comment-button', $_POST)) {
            $this->model->addComment(
                filter_var(trim($_POST['comment-nickname']), FILTER_SANITIZE_STRING),
                filter_var(trim($_POST['comment-text']), FILTER_SANITIZE_STRING)
            );
        }
    }

    function actionIndex()
    {
        $this->view->generate(
            'SetOfCards/setofcards.php',
            'default.php',
            $this->model->getData()
        );
    }
}