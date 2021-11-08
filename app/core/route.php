<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.



*/
class Route
{

	static function start()
	{
		
		
		
		
		
		/*
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "app/models/".$model_file;
		if(file_exists($model_path))
		{
			include "app/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "app/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "app/controllers/".$controller_file;
		}
		else
		{
			
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	*/


	

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
			
		}elseif ('/login' === $uri ) {
			
			{
				include 'app/controllers/controller_login.php';
				$controller = new Controller_Main;
				$controller->action_index();
							}
			
		} else {
			echo '<html><body><h1>Page Not Found</h1></body></html>';
			echo $uri;
		}

	}

	/*
		function ErrorPage404()
		{
			$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
			header('HTTP/1.1 404 Not Found');
			header("Status: 404 Not Found");
			header('Location:'.$host.'404');
    }*/
	
	
    
}
