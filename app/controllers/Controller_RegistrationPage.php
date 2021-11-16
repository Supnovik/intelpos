<?php

class Controller_RegistrationPage extends Controller
{
	function action_index()
	{	
		$this->model = new Model_RegistrationPage();
		$this->view->generate('Registration/registration.php', 'template_view.php');
	}
}
