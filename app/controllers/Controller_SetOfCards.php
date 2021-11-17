<?php

class Controller_SetOfCards extends Controller
{
    function action_index()
	{	
		$uri = explode('/', $_SERVER['REQUEST_URI']);
		$this->model = new Model_SetOfCards($uri[2],$uri[4]);
		$this->view->generate('SetOfCards/setofcards.php', 'template_view.php',$this->model->get_data());
	}
}