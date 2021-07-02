<?php 

class Number 
{
	private $secret;
	private $number;

	public function generateRandomNumber()
	{
		$this->number = mt_rand();
		return $this;
	}

	public function generateSecret()
	{
		$this->secret = bin2hex(random_bytes(20));
		return $this;
	}

	public function getNumber()
	{
		return $this->number;
	}

	public function getSecret()
	{
		return $this->secret;
	}
}