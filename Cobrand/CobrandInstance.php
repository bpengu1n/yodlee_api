<?php
class Cobrand_CobrandInstance
	extends Auth_ContextInstance
{
	// Cobrand Login Info
	private $_cobrandId;
	private $_appId;
	private $_apiPath;

	// Context Maintenance
	private $_timeout;
	private $_lastCreated;


	public function __construct()
	{
		$this->_timeout = COBRAND_TIMEOUT;
		$this->_lastCreated = 0; // Force initial login

		$this->_apiPath = '/authenticate/coblogin';
		$this->_loadLoginInfo();
		
		$this->_save();
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
			$this->_login();
		}

		return $this->_context->cobrandConversationCredentials->sessionToken;
	}

	private function _login()
	{
		$data = array(
				'cobrandLogin' => $this->_username,
				'cobrandPassword' => $this->_password
			);
		$restClient = new Rest_Client($this->_serverUrl.$this->_apiPath);

		$restClient->doCall($data);

		$this->_context = $restClient->getResponseObj();

		if (isset($this->_context->Error))
			throw new Exception('Error Authenticating Cobrand: '.$this->_context->Error[0]->errorDetail);
		else
		{
			$this->_lastCreated = intval(microtime(true));
			
			$this->_save();
		}
	}

	private function _loadLoginInfo()
	{
		$this->_cobrandId 	= COBRAND_ID;
		$this->_appId 		= COBRAND_APP_ID;
		$this->_username 	= COBRAND_USER;
		$this->_password 	= COBRAND_PASSWORD;
		$this->_serverUrl	= BASE_SERVER_URL;
	}
	
	private function _save()
	{
		$_SESSION['CobrandInstance'] 	= serialize($this);
	}

	// Prevent cloning of the instance
	private function __clone() { }
}