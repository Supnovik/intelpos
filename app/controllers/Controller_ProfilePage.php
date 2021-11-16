<?php
class Controller_ProfilePage extends Controller
{
	function action_index()
	{	
		$this->model = new Model_ProfilePage();
		$db = new Model_Database('data','users');
		$uri = explode('/', $_SERVER['REQUEST_URI']);
		if ($db->checking_for_existence($uri[2]))
			$this->view->generate('Profile/profile.php', 'template_view.php',$this->model->get_data($uri[2]));
		else
			{
				echo '<html><body><h1>Page Not Found</h1></body></html>';
				echo $uri[1];
			}
	}
}
