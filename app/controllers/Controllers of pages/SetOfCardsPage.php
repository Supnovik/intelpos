<?php

namespace Intelpos\Controller;

use Intelpos\Controller;
use Intelpos\Model;
use Intelpos\View;

class SetOfCardsPage extends Controller
{
    public $user;
    public $setofcards;
    public $isGenerated = false;

    function __construct($userNickname, $setofcards)
    {
        $this->user = $userNickname;
        $this->setofcards = $setofcards;

        $this->view = new View();
        $this->model = new Model\SetOfCards();
        if (array_key_exists('create-card', $_POST)) {
            $this->model->addCard(
                $this->setofcards,
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
            $this->isGenerated = true;
            $this->view->generate(
                'default',
                [
                    'cards' => $this->model->searchCards(
                        $setofcards,
                        filter_var(trim($_POST['search-card']), FILTER_SANITIZE_STRING)
                    ),
                    'comments' => $this->model->getComments($this->setofcards),
                ]
            );
        }

        if (array_key_exists('sortByAlphabet', $_POST)) {
            $this->isGenerated = true;
            $this->view->generate(
                'default', [
                    'cards' => $this->model->sortByAlphabet($this->setofcards),
                    'comments' => $this->model->getComments($this->setofcards),
                ]
            );
        }

        if (array_key_exists('comment-button', $_POST)) {
            $this->model->addComment(
                $this->setofcards,
                filter_var(trim($_POST['comment-nickname']), FILTER_SANITIZE_STRING),
                filter_var(trim($_POST['comment-text']), FILTER_SANITIZE_STRING)
            );
        }
    }

    function actionIndex()
    {
        if (!$this->isGenerated) {
            $this->view->generate(
                'default',
                $this->model->getData($this->setofcards)
            );
        }
    }
}