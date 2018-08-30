<?php
	class Router
	{
		private $url; // URL de la page à laquelle on veut accéder
		private $routes = []; // Contient la liste des routes, toutes les urls auxquelles ont peut accéder

		public function __construct($url)
		{
			$this->url = $url;
		}

		public function get($path, $callback)
		{
			$route = new Route($path, $callback);
			$this->routes["GET"][] = $route;

			return $route;	
		}

		public function run()
		{
			if (!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
				throw new RouterException("REQUEST_METHOD does not exist");
			foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
			{
				if ($route->match($this->url))
					return $route->call();
			}
			throw new RouterException( "No matching routes" );
		}
	}


?>