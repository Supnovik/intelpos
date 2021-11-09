<?php

class Controller_Main extends Controller
{
	function action_index()
	{	
		$this->view->generate('Login/login.php', 'template_view.php');
	}
}
