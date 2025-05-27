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
        http_response_code(404);
        header('Content-Type: application/json');

        echo json_encode([
            'status' => 'error',
            'code' => 404,
            'message' => 'Not found',
            'data' => null
        ]);
        exit;
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