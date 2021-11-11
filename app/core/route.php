<?php

class Route
{

	static function start()
	{
		
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		switch ($uri) {
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
			case '/admin':
				include 'app/controllers/controller_admin.php';
				$controller = new Controller_Admin;
				$controller->action_index();
				break;
				default:
				echo '<html><body><h1>Page Not Found</h1></body></html>';
				echo $uri;
				break;
		  }
	}
}
