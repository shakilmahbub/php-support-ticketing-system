<?php

/**
 * Home controller
 */

require_once '../app/models/User.php';
class HomeController extends Controller
{
	
	function __construct()
	{
		// code...
	}

	public function index()
	{
		return $this->json('This is the public function of home controller');
	}

	public function post($value)
	{
		$data = [
			'name' => $value['name'],
			'email' => $value['email'],
			'address' => $value['password']
		];

		$users = new User;

		$user = $users->createuser($data);
		
		return $this->json($user);

		$values = array_values($data);

		$keys = array_keys($data);
		return $this->json($keys);
	}
}