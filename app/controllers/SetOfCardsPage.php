<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class SetOfCardsPage extends Controller
{
    public $user;
    public $setofcards;

    function __construct($user, $setofcards)
    {
        $this->user = $user;
        $this->setofcards = $setofcards;
        $this->view = new View();
        $this->model = new Model\setOfCards($this->user, $this->setofcards);
        if (array_key_exists('create-card', $_POST)) {
            $this->model->addCard(
                filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING),
                filter_var(trim($_POST['definition']), FILTER_SANITIZE_STRING)
            );
        }
        if (array_key_exists('save-card', $_POST)) {
            $this->model->updateCard(
                filter_var(trim($_POST['oldtermin']), FILTER_SANITIZE_STRING),
                filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING),
                filter_var(trim($_POST['definition']), FILTER_SANITIZE_STRING)
            );
        }
        if (array_key_exists('delete-card', $_POST)) {
            $this->model->deleteCard(filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING));
        }

        if (array_key_exists('search-card-button', $_POST)) {
            $this->view->generate(
                'SetOfCards/setofcards.php',
                'template_view.php',
                [
                    'cards' => $this->model->searchCards(
                        filter_var(trim($_POST['search-card']), FILTER_SANITIZE_STRING)
                    ),
                    'comments' => $this->model->getComments(),
                ]
            );
        }

        if (array_key_exists('sortByAlphabet', $_POST)) {
            $this->view->generate(
                'SetOfCards/setofcards.php',
                'template_view.php',
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
            'template_view.php',
            ['cards' => $this->model->getData(), 'comments' => $this->model->getComments()]
        );
    }
}