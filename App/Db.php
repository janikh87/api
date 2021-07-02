<?php 

class Db
{
	protected $conn;
	public function __construct()
	{
	        try {
	            $this->conn = new PDO("sqlite:".__DIR__."/../inc/".DB_FILE);
	        } catch (\PDOException $e) {
	            print "Error during DB connection!: " . $e->getMessage() . "<br/>";
	            die();
	        }	
	}
}