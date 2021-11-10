<?php

class Controller_Admin extends Controller
{
	function action_index()
	{	
		$this->view->generate('Admin/admin.php', 'template_view.php');
	}
}
