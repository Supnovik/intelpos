<?php

include 'app/core/autoloading.php';

global $isLogin;
global $user;

class Route
{
	
	static function start()
	{
		$GLOBALS['isLogin'] = false;
		if (isset($_COOKIE['user']))
			{
				$GLOBALS['isLogin'] = true;
				$GLOBALS['user'] = $_COOKIE['user'];
			}
		$uri = explode('/', $_SERVER['REQUEST_URI']);
		switch ('/'.$uri[1]) {
			case '/':
				
				$controller = new Controller_MainPage;
				$controller->action_index();
			  break;
			case '/main':
				$controller = new Controller_MainPage;
				$controller->action_index();
			break;
			case '/login':
				$controller = new Controller_LoginPage;
				$controller->action_index();
				break;
			case '/registration':
				$controller = new Controller_RegistrationPage;
				$controller->action_index();
				break;
			case '/list_of_users':
				$controller = new Controller_List_of_usersPage;
				$controller->action_index();
				break;
			case '/users':
				$db = new Model_Database('data','users');
				$uri = explode('/', $_SERVER['REQUEST_URI']);
				$flag = false;
				if ($db->checking_for_existence($uri[2]) && !isset($uri[3])){
					$flag = true;
					$controller = new Controller_ProfilePage;
					$controller->action_index();
				}
				if ($db->checking_for_existence($uri[2]) && isset($uri[3]) && isset($uri[4])){
					$db = new Model_User($uri[2],$uri[2]);
					if($db->checking_setofcards_for_existence($uri[4]) && $uri[3] == 'setofcards')
					{
						$flag = true;
						$controller = new Controller_SetOfCardsPage();
						$controller->setData($uri[2],$uri[4]);
						$controller->action_index();
					}
					elseif($db->checking_setofcards_for_existence($uri[4]) && $uri[3] == 'backdrops')
					{
						$flag = true;
						$controller = new Controller_BackdropsListPage();
						$controller->setData($uri[2],$uri[4]);
						$controller->action_index();
					}
				}
				if (!$flag)
				{
					echo '<html><body><h1>Page Not Found</h1></body></html>';
					print_r($uri) ;
				}
				
				break;
			case '/admin':
				$controller = new Controller_AdminPage;
				$controller->action_index();
				break;
			case '/phpmyadmin':
				break;
			default:
				echo '<html><body><h1>Page Not Found</h1></body></html>';
				echo $uri[1];
				break;
		  }
	}
}
