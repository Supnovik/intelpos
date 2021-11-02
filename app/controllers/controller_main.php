<?php

class Controller_Main extends Controller
{
	function action_index()
	{	
		$this->view->generate('Main/main.php', 'template_view.php');
	}
}
