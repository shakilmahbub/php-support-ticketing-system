<?php

class Middleware
{
    public function __construct($arguments = [])
    {
        if (in_array('token',$arguments))
        {
            $this->executeToken();
        }
    }

    private function executeToken()
    {
        require_once '../app/middlewares/TokenMiddleware.php';

        $result = new TokenMiddleware();

        $result->handle();
    }
}