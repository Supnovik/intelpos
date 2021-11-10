<?php

class Route
{

	static function start()
	{
		
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		if ('/' === $uri) {
			{
				include 'app/controllers/controller_main.php';
				$controller = new Controller_Main;
				$controller->action_index();
							}
			
			
		} elseif ('/main' === $uri ) {
			
			{
				include 'app/controllers/controller_main.php';
				$controller = new Controller_Main;
				$controller->action_index();
							}
			
		} elseif ('/login' === $uri ) {
			
			{
				include 'app/controllers/controller_login.php';
				$controller = new Controller_Login;
				$controller->action_index();
				}
			
		}elseif ('/registration' === $uri ) {
			
			{
				include 'app/controllers/controller_registration.php';
				$controller = new Controller_Registration;
				$controller->action_index();
				}
			
		} elseif ('/admin' === $uri ) {
			
			{
				include 'app/controllers/controller_admin.php';
				$controller = new Controller_Admin;
				$controller->action_index();
				}
			
		} else {
			echo '<html><body><h1>Page Not Found</h1></body></html>';
			echo $uri;
		}

	}
}
