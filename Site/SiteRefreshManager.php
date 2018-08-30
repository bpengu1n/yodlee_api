<?php
// SiteRefreshManager.php
// SiteRefreshManager object
// @author: Benjamin Yunker

class Site_SiteRefreshManager
{	
	// Overloaded to construct object from raw data
	public function __construct()
	{
		if (func_num_args() == 3)
		{
			$cobToken 	= func_get_arg(0);
			$usrToken 	= func_get_arg(1);
			$acctId		= func_get_arg(2);
			
			$this->getRefreshInfo($cobToken, $usrToken, $acctId);
		}
		else if(func_num_args() == 1)
		{
			$data = func_get_arg(0);
			$this->_siteRefreshInfo = $data;
		}
		else
			return false;
			
	}
	
	public function isMFA()
	{
		return (isset($_siteRefreshInfo->siteRefreshMode->refreshModeId) && $_siteRefreshInfo->siteRefreshMode->refreshModeId == 1);
	}
	
	public function getRefreshInfo($cobToken, $usrToken, $id)
	{
		$apiUrl = "/Refresh/getSiteRefreshInfo";
		
		$data = array(
					'cobSessionToken'								=>	$cobToken,
					'userSessionToken'								=>	$usrToken,
					'memSiteAccId'									=>	$id
				);

		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);

		$restClient->doCall($data);
		
		$resp = $restClient->getResponseObj();
		
		if (isset($resp->Error))
			throw new Exception('Error In GetRefreshInfo: '.$this->_context->Error[0]->errorDetail);
		else
			$this->_siteRefreshInfo = $resp;
	}
	public function startSiteRefresh($cobToken, $usrToken, $acctId, $priority=1, $force=false)
	{
		$apiUrl = "/Refresh/startSiteRefresh";
		
		$data = array(
					'cobSessionToken'								=>	$cobToken,
					'userSessionToken'								=>	$usrToken,
					'memSiteAccId'									=>	$acctId,
					'refreshParameters.refreshPriority'				=>	$priority,
					'refreshParameters.refreshMode.refreshModeId'	=> 	(($this->isMFA())?1:2),
					'refreshParameters.refreshMode.refreshMode'		=> 	(($this->isMFA())?'MFA':'NORMAL'),
					'refreshParameters.forceRefresh'				=>	(($force)?'true':'false')
				);

		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);

		$restClient->doCall($data);
		
		$resp = $restClient->getResponseObj();
		
		if (isset($resp->Error))
			throw new Exception('Error In Refresh Start: '.$this->_context->Error[0]->errorDetail);
		else
			return $resp;
	}
	
	public function stopSiteRefresh($cobToken, $usrToken, $acctId)
	{
		$apiUrl = "/Refresh/stopSiteRefresh";
		
		$data = array(
					'cobSessionToken'	=>	$cobToken,
					'userSessionToken'	=>	$usrToken,
					'memSiteAccId'		=>	$acctId,
					'reason'    		=>	105
				);

		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);

		$restClient->doCall($data);

		$resp = $restClient->getResponseObj();
		
		
		if (isset($resp->Error))
			throw new Exception('Error In Refresh Stop: '.$this->_context->Error[0]->errorDetail);
		else
			return $resp;
	}
	
	public function getMfaResponse($cobToken, $usrToken, $acctId)
	{
		$retry = true;
		while($retry)
		{
			$apiUrl = "/Refresh/getMFAResponseForSite";
			
			$data = array(
						'cobSessionToken'	=>	$cobToken,
						'userSessionToken'	=>	$usrToken,
						'memSiteAccId'		=>	$acctId
					);
	
			$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);
	
			$restClient->doCall($data);
			
			$resp = $restClient->getResponseObj();
			
			$this->_lastMfaResponse = $resp;
			
			if (isset($resp->Error))
				throw new Exception('Error In Refresh Response: '.$this->_context->Error[0]->errorDetail);
			else
			{
				if ($resp->retry != 1)
					$retry = false;
			}
		}
		
		return $resp;
	}
	
	public function putMfaRequest()
	{
		global $cobrand, $user;
		
		$apiUrl = "/Refresh/putMFARequestForSite";
			
		$data = $_POST;
		$data = array(
					'cobSessionToken' 					=> $cobrand->getSessionToken(),
					'userSessionToken' 					=> $user->getSessionToken(),
					'memSiteAccId'						=> $_POST['memSiteAccId'],
					'userResponse.objectInstanceType'	=> 'com.yodlee.core.mfarefresh.MFAQuesAnsResponse'
		);
		
		$count = 0;
		
		foreach ($_POST['quesAnsDetailArray'] as $quesAnsDetails)
		{
			$data['userResponse.quesAnsDetailArray['.$count.'].answer'] = $quesAnsDetails['answer'];
			$data['userResponse.quesAnsDetailArray['.$count.'].answerFieldType'] = $quesAnsDetails['answerFieldType'];
			$data['userResponse.quesAnsDetailArray['.$count.'].metaData'] = $quesAnsDetails['metaData'];
			$data['userResponse.quesAnsDetailArray['.$count.'].question'] = $quesAnsDetails['question'];
			$data['userResponse.quesAnsDetailArray['.$count.'].questionFieldType'] = $quesAnsDetails['questionFieldType'];
			$count++;
		}
		
		
		print_r($data);
		
		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);

		$restClient->doCall($data);
		
		$resp = $restClient->getResponseObj();
		
		$this->_lastMfaResponse = $resp;
		echo "<!-- ";
		print_r($resp);
		echo "--!>";
		return $resp;
	}
	
	public function isMessageAvailable()
	{
		if (isset($this->_lastMfaResponse->isMessageAvailable) && 
			$this->_lastMfaResponse->isMessageAvailable == 1)
			return true;
		else
			return false;
	}
	
	// Private class members
	private $_siteRefreshInfo;
	private $_lastMfaResponse;
}