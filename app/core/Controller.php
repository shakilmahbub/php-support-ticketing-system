<?php

/**
 * Controller
 */
class Controller
{
	
	function __construct()
	{

	}

	public function json($data = [], $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}