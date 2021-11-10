<?php

class Controller_Registration extends Controller
{
	function action_index()
	{	
		$this->view->generate('Registration/registration.php', 'template_view.php');
	}
}
