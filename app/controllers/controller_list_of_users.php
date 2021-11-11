<?php
include 'app\models\model_List_of_users.php';
class Controller_List_of_users extends Controller
{
	function action_index()
	{	
		$this->model = new Model_List_of_users();
		$this->view->generate('List_of_users/list_of_users.php', 'template_view.php',$this->model->get_data());
	}
}
