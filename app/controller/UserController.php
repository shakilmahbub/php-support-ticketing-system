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

		return $this->json([
            'status' => 'success',
            'message' => 'Note created successfully',
            'data' => [
                'user' => $singleuser
            ]
        ]);
	}
	public function getuser()
	{
		$users = new User;

		$allusers = $users->users();

        return $this->json([
            'status' => 'success',
            'message' => 'Users list',
            'data' => [
                'users' => $allusers
            ]
        ]);
	}

	public function destroy($id)
	{
		if (!$id) {
			return $this->json('Please provide an id',400);
		}
		
		$user = new User;

		$user->deleteuser($id);

		return $this->json([
            'status' => 'success',
            'message' => 'Note deleted successfully',
            'data' => []
        ], 200);
	}


	public function store($value)
	{
        $errors = false;
        $message = [];
        if (!isset($value['name']))
        {
            $errors = true;
            $message[] = 'Name is required';
        }
        if (!isset($value['email']))
        {
            $errors = true;
            $message[] = 'Email is required';
        }
        if (!isset($value['password']))
        {
            $errors = true;
            $message[] = 'Password is required';
        }

        if ($errors)
        {
            return $this->json([
                'status' => 'error',
                'message' => $message,
                'data' => [
                    'user' => []
                ]
            ],422);
        }
		$data = [
            'name' => isset($value['name']) ? $value['name']: null,
            'email' => $value['email'] ? $value['email']: null,
            'password' => isset($value['password']) ? password_hash($value['password'], PASSWORD_BCRYPT): null,
            'role' => isset($value['role']) ? $value['role']: null
		];


		$users = new User;

		$user = $users->createuser($data);
		
		return $this->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => [
                'note' => $user
            ]
        ]);

	}

	public function update($post,$id)
	{
		$user = new User;

		$data = [
			'name' => isset($post['name']) ? $post['name']: null,
			'email' => isset($post['email']) ? $post['email'] : null,
			'password' => isset($post['password']) ? password_hash($post['password'], PASSWORD_BCRYPT) : null,
            'role' => isset($value['role']) ? $value['role']: null
		];
		
		$update = $user->updateuser($data,$id);

        return $this->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'data' => [
                'user' => $update
            ]
        ]);
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

