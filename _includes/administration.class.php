<?php
/*****************************************************
* Projet : Okovision - Supervision chaudiere OeKofen
* Auteur : Stawen Dronek
* Utilisation commerciale interdite sans mon accord
******************************************************/

class administration extends connectDb{
	
	public function __construct() {
		parent::__construct();
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
	/**
	* Send response to client. Any array will be transform into json
	*
	* @param Array $t Any array will be accepted
	*/
	
	private function sendResponse($t){
        header("Content-type: text/json; charset=utf-8");
		echo json_encode($t, JSON_NUMERIC_CHECK);
    }
	
	
	
	/**
	* Function notify stawen's server for making a update
	* 
	* @return json 
	*/
	/*
	public function addOkoStat(){
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		$host = $_SERVER['HTTP_HOST'];
		$folder = dirname($_SERVER['SCRIPT_NAME']);
		$source = $host.$folder;
		
		
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_URL => $this->_urlApi,
		    CURLOPT_USERAGENT => 'Okovision :-:'.TOKEN.':-:',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => array(
		        'token' => TOKEN,
		        'source' => $source,
		        'version' => $this->getCurrentVersion()
		    )
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		//var_dump($resp);
		curl_close($curl);
	}
	*/
	/**
	* Function getting/sending live value into boiler
	* 
	* @return json
	*/
	/*
	private function curlGet($action = 'get&attr=1'){
		$code = false;
	    $curl = curl_init();
	    
	    curl_setopt_array($curl, array(
	           CURLOPT_VERBOSE => false,
			   CURLOPT_RETURNTRANSFER => true,
			   CURLOPT_URL => $this->_loginUrl.'?action='.$action,
			   CURLOPT_POST => 1,
			   CURLOPT_HTTPHEADER => array(
			        'Accept: application/json',
	                'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
	                'Accept-Language: en'),
			   CURLOPT_COOKIEFILE => $this->_cookies,
			   CURLOPT_POSTFIELDS => $this->_formdata
			   
			));
	    
	    $resp = curl_exec($curl);
	    
	    if(!curl_errno($curl)){
	        
	        $info = curl_getinfo($curl);
	        
	        if($info['http_code'] == '200'){
	            $this->_responseBoiler = $resp;
	            $this->log->debug("Class ".__CLASS__." | ".__FUNCTION__." | ". $resp);
	        	$code = true;
	        }
	    }
	    
	    curl_close($curl);
	    return $code;
	}
	
	*/
	/**
	* Function login. Check if user/password is ok
	* 
	* @return json 
	*/
	
	public function login($user,$pass){
		
		$this->log->debug("Class ".__CLASS__." | ".__FUNCTION__." | ".$user." / ".$pass);
		
		$r['response'] = false;
	 	
    	if ($user ==='krolanta' && $pass === 'wazawaza') {
    		$r['response'] = true;
    		session::getInstance()->setVar("typeUser", 'Standard');
    		session::getInstance()->setVar("logged", true);
    		session::getInstance()->setVar("userId", '1');
    		$this->log->info("Class ".__CLASS__." | ".__FUNCTION__." | ".$_SERVER['REMOTE_ADDR']);
    	}
	   	$this->sendResponse($r);
	}
	
	/**
	* Function logout. destroy session
	* 
	* @return json 
	*/
	public function logout(){
		session::getInstance()->deleteVar("logged");
		session::getInstance()->deleteVar("typeUser");
		session::getInstance()->deleteVar("userId");
		$r['response'] = true;
		$this->sendResponse($r);
			
	}
	
	

}

?>