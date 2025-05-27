<?php
require_once '../app/interface/MiddlewareInterface.php';
require_once '../app/models/User.php';
class TokenMiddleware implements MiddlewareInterface
{
    public function handle()
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization']))
        {
            $this->error_return();
        }

        $token = str_replace('Bearer ','',$headers['Authorization']);
        $hashtoken = md5($token);
        $query = Db::connection()->query("SELECT user_id FROM tokens where token = '$hashtoken'");
        $check_token = $query->fetch(PDO::FETCH_OBJ);
        if ($check_token)
        {
            $user = new User;
            $userdetails = $user->user($check_token->user_id);
            $_SESSION['logged_in_user'] = $userdetails;
            return true;
        }
        else
        {
            $this->error_return();
        }
    }

    public function error_return()
    {
        $_SESSION['logged_in_user'] = null;
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Unauthorized request'
        ]);

        exit();
    }
}