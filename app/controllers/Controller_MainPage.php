<?php

class Controller_MainPage extends Controller
{
	function action_index()
	{	
		$this->view->generate('Main/main.php', 'template_view.php');
	}
}
