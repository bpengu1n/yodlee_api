<?php

class Cobrand_CobrandInstance
	extends Auth_ContextInstance
{
	// Cobrand Login Info
	private $cobrandId;
	private $appId;

	// Context Maintenance
	private $timeout;
	private $lastCreated;


	public function __construct()
	{
		$this->lastCreated = 0; // Force initial login

		$this->loadLoginInfo();
	}

	// Reimplementation of getContext with
	//	context aging implemented
	public function getContext()
	{
		// Compare lastCreated with current time
		// 	If exceeds timeout, recreate context
		return $this->context;
	}

	private function loadLoginInfo()
	{
		$this->cobrandId 	= COBRAND_ID;
		$this->appId 		= COBRAND_APP_ID;
		$this->username 	= COBRAND_USER;
		$this->password 	= COBRAND_PASSWORD;
		$this->serverUrl	= SOAP_SERVER_URL;
	}

	// Prevent cloning of the instance
	private function __clone() { }
}