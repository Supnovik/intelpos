<?php

class Controller_RegistrationPage extends Controller
{
	function action_index()
	{	
		$this->view->generate('Registration/registration.php', 'template_view.php');
	}
}
