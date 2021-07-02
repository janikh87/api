<?php 

Class ApiController {

	protected $http_statuses =  [
			200 => 'OK',
			400 => 'Bad Request',  
			401 => 'Unauthorized',     
			404 => 'Not Found',  
			500 => 'Internal Server Error',
	];


	public function __construct()
	{
		if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
		    if (strpos(strtolower($_SERVER['REDIRECT_HTTP_AUTHORIZATION']),'basic')===0) {
		        list($username,$password) = explode(':',base64_decode(substr($_SERVER['REDIRECT_HTTP_AUTHORIZATION'], 6)));
		        if($username == AUTH_USER && $password == AUTH_PWD) {
		        	return $this;
		        }
			}
		}
		$this->renderError(401,'Unauthorized');
	}

	protected function renderError($http_code, $msg = false) {
		$this->setHttpHeaders($http_code);
		$data = ['success' => false];
		if($msg) {
			$data['msg'] = $msg;		
		}	
		die(json_encode($data));
	}

	protected function renderSuccess($data) {
		$this->setHttpHeaders(200);
		$data['success'] = true;
		die(json_encode($data));
	}


	public function setHttpHeaders($http_code){
		
		header("HTTP/1.1 ". $http_code ." ". $this->http_statuses[$http_code]);		
		header("Content-Type: application/json");
	}
}