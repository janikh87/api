<?php 

class NumberApiController extends ApiController {

	protected $number_table;

	public function process(){
		if(isset($_GET['action'])) {
			switch($_GET['action']) {
				case 'generate':
					$this->generateNumber();
				break;
				case 'retrieve':
					$this->retrieveNumber();
				break;
				default:
					$this->renderError(400);
				break;
			}
		} else {
			$this->renderError(404);
		}
	}

	protected function generateNumber()
	{
		$number = new Number();
		$number->generateRandomNumber()->generateSecret();
		if($this->getNumberTable()->saveNumber($number)) {
			$data = [
				'secret' => $number->getSecret()
			];
			return $this->renderSuccess($data);
		} else {
			return $this->renderError(500, 'Database error');
		}

	}

	protected function retrieveNumber()
	{
		if(!isset($_GET['secret'])) {
			$this->renderError(400, 'Secret missing');
		} else {
			$number = $this->getNumberTable()->getNumberBySecret($_GET['secret']);
			if(!$number) {
				$this->renderError(404,'No data found for given secret');
			} 
			$data = [
				'number' => $number
			];
			return $this->renderSuccess($data);

		}
	}

	protected function getNumberTable()
	{
		if(!isset($this->number_table)) {
			$this->number_table = new NumberTable();
		}
		return $this->number_table;
	}
}