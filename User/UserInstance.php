<?php
// UserContext.php
// UserContext object 
//	represents an authenticated user conversational session. 
// @author: Benjamin Yunker

class User_UserInstance
	extends Auth_ContextInstance
{	
	// API 
	private $_apiPath;

	// User Login 
	private $_user;
	private $_pass;

	private $_cobInstance;

	// Context Maintenance
	private $_timeout;
	private $_lastCreated;

	public function __construct(&$cobInstance, $user="", $pass="")
	{
		$this->_timeout = USER_TIMEOUT;
		$this->_lastCreated = 0; // Force initial login
		print_r($cobInstance);
		// Initialize private members
		$this->_cobInstance = $cobInstance;
		$this->_user = $user;
		$this->_pass = $pass;

		$this->_apiPath = 'authenticate/login';
		$this->_loadApiInfo();
	}
	// Reimplementation of getContext with
	//	context aging implemented
	public function getSessionToken()
	{
		// Compare lastCreated with current time
		// 	If exceeds timeout, recreate context
		$currInterval = intval(microtime(true)) - $this->_lastCreated;
		if($currInterval >= $this->_timeout)
		{
			throw new Exception('User Session Expired');
		}

		return $this->context->conversationCredentials->sessionToken;
	}

	public function login()
	{

		$data = array(
				'cobSessionToken' => urlencode($this->_cobInstance->getSessionToken()),
				'user' => urlencode($this->_user),
				'password' => urlencode($this->_pass)
			);
		print_r($data);
		$restClient = new Rest_Client($this->serverUrl.$this->_apiPath);

		$restClient->doCall($data);

		$this->context = $restClient->getResponseObj();

		if (isset($this->context->Error))
			throw new Exception('Error Authenticating User: '.$this->context->Error[0]->errorDetail);
		else
			$this->_lastCreated = intval(microtime(true));
	}

	private function _loadApiInfo()
	{
		$this->serverUrl	= REST_SERVER_URL;
	}

	// Prevent cloning of the instance
	private function __clone() { }
};
?>