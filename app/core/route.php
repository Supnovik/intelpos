<?php

class Route
{

	static function start()
	{
		
		$uri = explode('/', $_SERVER['REQUEST_URI']);
		switch ("/".$uri[1]) {
			case '/':
				include 'app/controllers/controller_main.php';
				$controller = new Controller_Main;
				$controller->action_index();
			  break;
			case '/main':
				include 'app/controllers/controller_main.php';
				$controller = new Controller_Main;
				$controller->action_index();
			break;
			case '/login':
				include 'app/controllers/controller_login.php';
				$controller = new Controller_Login;
				$controller->action_index();
				break;
			case '/registration':
				include 'app/controllers/controller_registration.php';
				$controller = new Controller_Registration;
				$controller->action_index();
				break;
			case '/list_of_users':
				include 'app/controllers/controller_list_of_users.php';
				$controller = new Controller_List_of_users;
				$controller->action_index();
				break;
			case '/users':
				include 'app/controllers/controller_profile_page.php';
				$controller = new Controller_ProfilePage;
				$controller->action_index();
				break;
			case '/admin':
				include 'app/controllers/controller_admin.php';
				$controller = new Controller_Admin;
				$controller->action_index();
				break;
			default:
				echo '<html><body><h1>Page Not Found</h1></body></html>';
				echo $uri[1];
				break;
		  }
	}
}
