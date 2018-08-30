<?php
// Site.php
// Site object
// @author: Benjamin Yunker

class Site_Site
{	
	// Overloaded to construct object from raw data
	public function __construct($data)
	{
		$this->_siteData = $data;
	}
	
	public function getId()
	{
		return $this->_siteData->siteId;
	}
	
	public function getSiteName()
	{
		return $this->_siteData->defaultDisplayName;
	}
	
	public function getComponentList()
	{
		return $this->_siteData->loginForms[0]->componentList;
	}
	
	// Call addSiteAccount1
	//	formVals is an assoc array with key = component NAME; value = input value
	public function add($cobToken, $usrToken, $formVals)
	{
		$addApiPath = '/SiteAccountManagement/addSiteAccount1';
		$data = array(
				'cobSessionToken' 	=> $cobToken,
				'userSessionToken' 	=> $usrToken,
				'siteId'			=> $this->_siteData->siteId,
				// For general login/password fields
				// 	Could be com.yodlee.common.FieldInfoMultiFixed during MFA flow
				'credentialFields.enclosedType'	=> 'com.yodlee.common.FieldInfoSingle'  
			);
		
		$compNum = 0;
		foreach($this->_siteData->loginForms[0]->componentList as $formComponent)
		{
			$data['credentialFields['.$compNum.'].displayName'] = $formComponent->displayName;
			$data['credentialFields['.$compNum.'].fieldType.typeName'] = $formComponent->fieldType->typeName;
			$data['credentialFields['.$compNum.'].helpText'] = $formComponent->helpText;
			$data['credentialFields['.$compNum.'].maxlength'] = $formComponent->maxlength;
			$data['credentialFields['.$compNum.'].name'] = $formComponent->name;
			$data['credentialFields['.$compNum.'].size'] = $formComponent->size;
			$data['credentialFields['.$compNum.'].value'] = $formVals[$formComponent->name];
			$data['credentialFields['.$compNum.'].valueIdentifier'] = $formComponent->valueIdentifier;
			$data['credentialFields['.$compNum.'].valueMask'] = $formComponent->valueMask;
			$data['credentialFields['.$compNum.'].isEditable'] = $formComponent->isEditable;
			$compNum++;
		}
			
		
		$restClient = new Rest_Client(EXTD_SERVER_URL.$addApiPath);

		//print_r($data);
		
		//print_r($restClient);

		//print_r($data);

		$restClient->doCall($data);

		$this->_addResponse = $restClient->getResponseObj();
		
		// Some sites may require additional info at this point,
		//	test to find what form this must take, and whether we call
		//	addSiteAccount1 again...

		if (isset($this->_addResponse->Error))
			throw new Exception('Error Adding Site: '.$this->_context->Error[0]->errorDetail);
		else
		{
			// MFAOBJECT
			//	mfaType - typeId:
			//		4 - SECURITY_QUESTION
			//print_r($this->_addResponse);
			//echo "\n<br />";
			if(isset($this->_addResponse->siteRefreshInfo))
				$this->_refreshMan = new Site_SiteRefreshManager($this->_addResponse->siteRefreshInfo);
			else
				$this->_refreshMan = new Site_SiteRefreshManager($cobToken, $usrToken, $this->getMemSiteAccId());

//			if (true)
//			{
				// MFA REFRESH FLOW
				
				//echo "RESP: ";
				
				//print_r($mfaResp);
				
				//$this->_save();
				
				//return $mfaResp;
//			}
//			else 
//			{
				// NORMAL REFRESH FLOW
//				echo "NORMAL";
//			}
			$this->_save();
		}
	}
	
	// Handles removal of site
	public function remove()
	{
		global $cobrand, $user;
		$cobToken = $cobrand->getSessionToken();
		$usrToken = $user->getSessionToken();
		
		if(!$this->getMemSiteAccId())
			return false;
		else
		{
			$remApiPath = '/SiteAccountManagement/removeSiteAccount';
			$data = array(
					'cobSessionToken' 	=> $cobToken,
					'userSessionToken' 	=> $usrToken,
					'memSiteAccId'		=> $this->getMemSiteAccId()
				);
			
			$restClient = new Rest_Client(EXTD_SERVER_URL.$remApiPath);
	
			$restClient->doCall($data);
	
			$resp = $restClient->getResponseObj();
			
			unset($_SESSION['siteCache']);
			
			$this->_addResponse = null;
			$this->_refreshMan = null;

			return $resp;
		}
	}
	
	public function putMFARequest()
	{
		return $this->_refreshMan->putMFARequest();
	}
	
	public function getMFAType()
	{
		if (isset($this->_addResponse->siteInfo) && 
			isset($this->_addResponse->siteInfo->mfaType))
			return $this->_addResponse->siteInfo->mfaType->typeName;
		else
			return false;
	}
	public function getMemSiteAccId()
	{
		if (isset($this->_addResponse->siteAccountId))
			return $this->_addResponse->siteAccountId;
		else
			return false;
	}
	public function isMessageAvailable()
	{
		if (is_object($this->_refreshMan))
			return $this->_refreshMan->isMessageAvailable();
		else
			return false;
	}
	
	public function doMfaRequest($cobToken, $usrToken)
	{	
		global $ERR_CODES;
				
		
		$this->_refreshMan->startSiteRefresh($cobToken, $usrToken, $this->getMemSiteAccId(), 1, true);
		
		// putMfaRequest if MFA data found in POST
		if (isset($_POST['memSiteAccId']))
		{
			$this->putMfaRequest();
		}
		$mfaResp = $this->_refreshMan->getMfaResponse($cobToken, $usrToken, $this->getMemSiteAccId());
		
		// Check for error here
		if (isset($mfaResp->errorCode) && $mfaResp->errorCode > 0)
		{
			$this->_refreshMan->stopSiteRefresh($this->getMemSiteAccId());
			$this->remove();
			throw new Exception('MFA Authentication Error: '.$ERR_CODES[$mfaResp->errorCode]);
		}
		
		
		
		return $mfaResp;
	}
	
	// Private class members
	private $_siteData;
	private $_addResponse;
	private $_lastSearch;
	private $_refreshMan;
	
	// Persist object in session
	private function _save()
	{
		$_SESSION['siteCache'] = serialize($this);
	}
}