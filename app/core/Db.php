<?php 

/**
 * Database connection system
 */
class Db
{

	public static function connection()
	{
		$servername = "localhost";
		$dbname = 'ticketing-system';
		$username = "root";
		$password = "";
		try {
		  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		  return $conn;
		  
		} catch(PDOException $e) {
		  echo "Connection failed: " . $e->getMessage();
		}
	}
}