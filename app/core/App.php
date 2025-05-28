<?php

/**
 * App class
 */
class App
{
	protected $controller = 'HomeController';
	protected $method = 'index';
	protected $perams = [];

    protected $protectedRoute = 1;

	public function __construct()
	{
        // start middleware
//        $middleware = new Middleware(['token']);

		$urls = $this->parse_url();

        $routes = Route::$routes;
        foreach ($routes as $key => $route)
        {
            $func = '';
            $link = explode('/',$route['route']);
            if ($urls[0] == $link[0])
            {
                if ($_SERVER['REQUEST_METHOD'] == $route['method'])
                {
                    if (count($urls) == count($link)){
                        if (isset($urls[2]))
                        {
                            if ($urls[2] == $link[2])
                            {
                                $this->controller = $route['controller'];
                                $this->method = $route['function'];
                            }
                        }
                        else{
                            $this->controller = $route['controller'];
                            $this->method = $route['function'];
                        }

                        if (isset($route['protection_type']) && $route['protection_type'] == 'public')
                        {
                            $this->protectedRoute = 0;
                        }
                    }
                }
            }

        }
        if ($this->protectedRoute)
        {
            new Middleware(['token']);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($urls[1])) {
            $this->perams = isset($urls[1]) ? [$urls[1]] : null;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->perams = [$_POST];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'PATCH') {
            $data = (array) json_decode(file_get_contents("php://input"), true);


            $this->perams = [$data,isset($urls[1]) ? $urls[1] : null];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $this->perams = isset($urls[1]) ? [$urls[1]] : null;
        }
        try {
            require_once '../app/controller/'.$this->controller.'.php';
            $this->controller = new $this->controller;
            call_user_func_array([$this->controller, $this->method], $this->perams);
        }
        catch (Exception $e)
        {
            http_response_code(500);
            header('Content-Type: application/json');

            echo json_encode([
                'status' => 'error',
                'code' => 500,
                'message' => 'Opps! Something went wrong!',
                'data' => null
            ]);
            exit;
        }

	}


	public function parse_url()
	{
		if (isset($_GET['url'])) {
			return $url = explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
		}
	}
}