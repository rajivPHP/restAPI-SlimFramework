<?php

class RestAPI {
	//Database connection link
	private $con;

	//Class constructor
	function __construct() {
		//Getting the DbConnect.php file
		require_once dirname( __FILE__ ) . '/../db/DbConnect.php';

		//Creating a DbConnect object to connect to the database
		$db = new DbConnect();

		//Initializing our connection link of this class
		//by calling the method connect of DbConnect class
		$this->con = $db->connect();
	}

	//Method for user login
	public function userLogin( $username, $pass ) {
		$password = md5( $pass );
		$stmt = $this->con->prepare( "SELECT * FROM users WHERE username=? and password=?" );
		$stmt->bind_param( "ss", $username, $password );
		$stmt->execute();
		$stmt->store_result();
		$num_rows = $stmt->num_rows;
		$stmt->close();
		return $num_rows > 0;
	}

	//This method will return student detail
	public function getBooks() {
		$stmt = $this->con->prepare( "SELECT * FROM library" );
		//$stmt->bind_param( "s", $username );
		$stmt->execute();
		//Getting the student result array
		$library = $stmt->get_result()->fetch_assoc();
		$stmt->close();

		//returning the student
		return $library;
	}


	//This method will generate a unique api key
	private function generateApiKey() {
		return md5( uniqid( rand(), true ) );
	}
}
