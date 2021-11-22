<?php

class Controller_BackdropsListPage extends Controller
{
    protected $user;
    protected $setofcards;

    function setData($user, $setofcards)
    {
        $this->user = $user;
        $this->setofcards = $setofcards;
    }

    function action_index()
    {
        $this->model = new Model_BackdropsListPage();
        $this->view->generate('BackdropsList/backdropsList.php', 'template_view.php', $this->model->get_data($this->user, $this->setofcards));
    }
}