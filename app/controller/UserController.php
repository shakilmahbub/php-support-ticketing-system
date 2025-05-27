<?php 
	
/**
 * User controller
 */
require_once '../app/models/User.php';

class UserController extends Controller
{
	public function show($id)
	{
		$user = new User;

		$singleuser = $user->user($id);

		return $this->json($singleuser);
	}
	public function getuser()
	{
		$users = new User;

		$allusers = $users->users();

		return $this->json($allusers);
	}

	public function distroy($id)
	{
		if (!$id) {
			return $this->json('Please provide an id',400);
		}
		
		$user = new User;

		$user->deleteuser($id);

		return $this->json('User deleted successful', 204);
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

	public function update($post,$id)
	{
		$user = new User;

		$data = [
			'name' => isset($post['name']) ? $post['name']: null,
			'email' => $post['email'] ? $post['email']: null,
			'address' => isset($post['password']) ? $post['password']: null
		];
		
		$us = $user->updateuser($data,$id);

		return $this->json($us);
		return $this->json([$post,$id]);
	}



    public function registration($value)
    {
        $data = [
            'name' => $value['name'],
            'email' => $value['email'],
            'password' => password_hash($value['password'], PASSWORD_BCRYPT),
            'role' => $value['role']
        ];


        $users = new User;

        $user = $users->createuser($data);

        return $this->json($user);
    }

    public function login($value)
    {
        $user = new User;

        $userdetails = $user->getUserDetailsByEmail($value['email']);

        if ($userdetails)
        {
            if (password_verify($value['password'],$userdetails->password))
            {
                $token = bin2hex(random_bytes(16 / 2));

                $hashtoken = md5($token);
                $date = date('Y-m-d H:i:s');
                Db::connection()->query("INSERT INTO tokens (`token`,`user_id`,`created_at`) VALUES ('$hashtoken','$userdetails->id','$date')");


                return $this->json([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => [
                        'token' => $token,
                        'user' => $userdetails
                    ]
                ]);
            }
        }
        else
        {
            return $this->json('Invalid login details!');
        }

    }


    public function logout()
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization']))
        {
            return $this->json('Invalid details!');
        }

        $token = str_replace('Bearer ','',$headers['Authorization']);
        $hashtoken = md5($token);
        $user = new User;

        $query = Db::connection()->query("SELECT * FROM tokens WHERE token ='$hashtoken'" );
        $userdetails = $query->fetch(PDO::FETCH_OBJ);

        if ($userdetails)
        {
                Db::connection()->query("DELETE FROM tokens WHERE token = '$hashtoken'");

                return $this->json([
                    'status' => 'success',
                    'message' => 'Logout successful',
                    'data' => []
                ]);
        }
        else
        {
            return $this->json('Invalid login details!');
        }
    }
}

