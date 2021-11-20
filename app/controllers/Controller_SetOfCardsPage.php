<?php

class Controller_SetOfCardsPage extends Controller
{
	protected $user;
	protected $setofcards;
	function setData($user,$setofcards)
	{
		$this->user =$user;
		$this->setofcards =$setofcards;
	}



    function action_index()
	{	
		$this->model = new Model_SetOfCards($this->user,$this->setofcards);
		$this->view->generate('SetOfCards/setofcards.php', 'template_view.php',$this->model->get_data());
	}
}