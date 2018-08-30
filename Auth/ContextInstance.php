<?php
class Auth_ContextInstance
{
	protected $_client;
	protected $_context;
	protected $_username;
	protected $_password;
	protected $_serverUrl;

	public function getContext()
	{
		return $this->_context;
	}
	public function getUsername()
	{
		return $this->_username;
	}
	protected function loginCobrand($params)
	{
		$this->_context = $this->_doCall("loginCobrand", $params);

		return true;
	}
	protected function doCall($service, $params)
	{
		try
		{
			$response = $this->_client->__soapCall($service, $params);
		} 
		catch(SoapFault $fault)
		{
			echo "<pre>" . $this->_client->__getLastRequest()."</pre>";
			echo "\n\nException: <pre>";
			echo str_replace(array(COBRAND_ID, COBRAND_APP_ID, COBRAND_USER, COBRAND_PASSWORD), "*****",print_r($fault, true));
			echo "</pre>\n\n";

			return false;
		}

		return $response;
	}
}