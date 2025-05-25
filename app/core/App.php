<?php

/**
 * App class
 */
class App
{
	protected $controller = 'HomeController';
	protected $method = 'index';
	protected $perams = [];


	public function __construct()
	{

		$urls = $this->parse_url();

	
		if (isset($urls[0]) && file_exists('../app/controller/'.ucfirst($urls[0]).'Controller.php')) {

		
			$this->controller = ucfirst($urls[0]).'Controller';

			unset($urls[0]);

		}

		require_once '../app/controller/'.$this->controller.'.php';

		$this->controller = new $this->controller;

		if (isset($urls[1])) {
			
			if (method_exists($this->controller, $urls[1])) {

				$this->method = $urls[1];
				unset($urls[1]);
			}
			
		}

		$this->perams = $urls ? array_values($urls) : [];

		if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($urls[2])) {
			$this->perams = isset($urls[2]) ? [$urls[2]] : null;
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->perams = [$_POST];
		}

		if ($_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'PATCH') {
			$data = (array) json_decode(file_get_contents("php://input"), true);

		
			$this->perams = [$data,isset($urls[2]) ? $urls[2] : null];
		}

		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			$this->perams = isset($urls[2]) ? [$urls[2]] : null;
		}

		call_user_func_array([$this->controller, $this->method], $this->perams);
		
	}


	public function parse_url()
	{
		if (isset($_GET['url'])) {
			return $url = explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
		}
	}
}