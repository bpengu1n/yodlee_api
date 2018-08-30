<?php
class Auth_ContextInstance
{
	protected $sess_token;
	protected $username;
	protected $password;
	protected $serverUrl;

	public function getContext()
	{
		return $this->context;
	}
	public function getUsername()
	{
		return $this->username;
	}
}