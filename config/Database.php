<?php

class DbConnect{

	private $host;
	private $username;
	private $pass;
	private $dbname;

	function __construct(){
		//Set database connection parameters
		$this->host = $_ENV['DB_HOST'];
		$this->username = $_ENV['DB_USERNAME'];
		$this->pass = $_ENV['DB_PASS'];
		$this->dbname = $_ENV['DB_NAME'];
	}

	//Connect to database
	public function connect(){
		$con = mysqli_connect($this->host, $this->username, $this->pass, $this->dbname);
		if (mysqli_connect_errno()){
		    return "Failed to connect to MySQL: " . mysqli_connect_error();
	    }

		return $con;
	}
}