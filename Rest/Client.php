<?php
class Rest_Client
{
	private $path;
	private $lastResponse;

	public function __construct($path) 
	{ 
		$this->path = $path;
	}

	public function doCall($data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 360);
		curl_setopt($ch, CURLOPT_POST, count($data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

		$this->lastResponse = curl_exec($ch);
		curl_close($ch);
	}

	public function getResponseObj()
	{
		return $this->jsonDecode($this->lastResponse);
	}

	public function getResponseArr()
	{
		return $this->jsonDecode($this->lastResponse, true);
	}
	
	private function jsonDecode($json, $assoc = false){ 
	    $json = str_replace(array("\n","\r"),"",$json); 
	    $json = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/','$1"$3":',$json);
	    $json = preg_replace('/(,)\s*}$/','}',$json);
	    return json_decode($json,$assoc); 
	}
};