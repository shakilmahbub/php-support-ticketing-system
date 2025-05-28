<?php 

/**
 * User model
 */
class User extends Model
{
	private $table = 'users';

	function __construct()
	{
		// code...
	}


	public function users()
	{
		$users = $this->getall($this->table);

        $users = array_map(function($user) {
            unset($user->password);
            return $user;
        }, $users);

		return $users;
	}

	public function user($id)
	{
		$user = $this->single($this->table,$id);
        unset($user->password);
		return $user;
	}


	public function createuser($data)
	{
		$entry = $this->create($this->table,$data);
        unset($entry->password);
		return $entry;
	}


	public function deleteuser($id)
	{
		$entry = $this->delete($this->table,$id);

		return $entry;
	}


	public function updateuser($data, $id)
	{
		$entry = $this->update($this->table, $data, $id);
        unset($entry->password);
		return $entry;
	}

    public function getUserDetailsByEmail($email)
    {
        $details = Db::connection()->query("SELECT * FROM $this->table where email = '$email'");

        $data = $details->fetch(PDO::FETCH_OBJ);

        return $data;
    }
}