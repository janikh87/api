<?php 

class NumberTable extends Db
{
	public function saveNumber(Number $number) 
	{
		$sqlQuery = "INSERT INTO numbers(`secret`, `number`) VALUES(:secret, :number)";
        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindValue(":secret", $number->getSecret(), PDO::PARAM_STR);
        $statement->bindValue(":number", $number->getNumber(), PDO::PARAM_INT);
        return $statement->execute();
	}

	public function getNumberBySecret($secret) 
	{
		$sqlQuery = "SELECT `number` FROM numbers WHERE `secret` = :secret";
        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":secret", $secret, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn();
	}
}


