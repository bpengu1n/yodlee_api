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
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$this->lastResponse = curl_exec($ch);
		curl_close($ch);
	}

	public function getResponseObj()
	{
		return json_decode($this->lastResponse);
	}

	public function getResponseArr()
	{
		return json_decode($this->lastResponse, true);
	}
};