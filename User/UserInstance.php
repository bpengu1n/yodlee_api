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

		// Initialize private members
		$this->_cobInstance = $cobInstance;
		$this->_user = $user;
		$this->_pass = $pass;

		$this->_apiPath = 'authenticate/login';
		$this->_loadApiInfo();
		
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
			$this->login();
		}
		
		return $this->context->conversationCredentials->sessionToken;
	}
	
	public function register()
	{
		// Registration info in POST data
		//	loginName - REQUIRED
		//	password - REQUIRED
		//	emailAddress - REQUIRED
		//	firstName - OPTIONAL
		//	lastName - OPTIONAL
		//	middleInitial - OPTIONAL
		//	address1 - Optional
		//	address2 - Optional
		// 	city - OPTIONAL
		//	country - OPTIONAL
		$regApiPath = '/UserRegistration/register3';
		$data = @array(
				'cobSessionToken' =>					$this->_cobInstance->getSessionToken(),
				'userCredentials.objectInstanceType' =>	'com.yodlee.ext.login.PasswordCredentials',
				'userCredentials.loginName' => 			$_POST['loginName'],
				'userCredentials.password' =>			$_POST['password'],
				'userProfile.emailAddress' =>			$_POST['emailAddress'],
				'userPreferences[0]' =>					'PREFERRED_CURRENCY~USD',
				'userPreferences[1]' =>					'PREFERRED_DATE_FORMAT~MM/dd/yyyy',
				'userProfile.firstName' =>				$_POST['firstName'],
				'userProfile.lastName' =>				$_POST['lastName'],
				'userProfile.middleInitial' =>			$_POST['middleInitial'],
				'userProfile.objectInstanceType' =>		'com.yodlee.core.usermanagement.UserProfile',
				'userProfile.address1' =>				$_POST['address1'],
				'userProfile.address2' =>				$_POST['address2'],
				'userProfile.city' =>					$_POST['city'],
				'userProfile.country' =>				$_POST['country']
				);
				
		$restClient = new Rest_Client(EXTD_SERVER_URL.$regApiPath);
		
		$restClient->doCall($data);
		
		$resp = $restClient->getResponseObj();
		
		if (isset($resp->Error))
			throw new Exception('Error Registering User: '.$resp->Error[0]->errorDetails);
		else
		{
			print_r($resp);
			if (!is_object($resp) || !isset($resp->userContext))
				throw new Exception('Error Registering User: No Response from Server');

			$this->_context = $resp->userContext;
			$this->_lastCreated = intval(microtime(true));
			$this->_user = $_POST['loginName'];
			$this->_pass = $_POST['password'];
			
			$this->_save();
		}
					
	}

	public function login()
	{

		$data = array(
				'cobSessionToken' => 	$this->_cobInstance->getSessionToken(),
				'login' => 				$this->_user,
				'password' => 			$this->_pass
			);

		$restClient = new Rest_Client($this->serverUrl.$this->_apiPath);

		$restClient->doCall($data);

		$resp = $restClient->getResponseObj();

		if (isset($resp->Error))
			throw new Exception('Error Authenticating User: '.$resp->Error[0]->errorDetail);
		else
		{
			$this->context = $resp->userContext;
			$this->_lastCreated = intval(microtime(true));
			
			$this->_save();
		}
	}
	
	public function logout()
	{
		$apiUrl = '/Login/logout';
		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);
		
		$data = array(
				'cobSessionToken'	=> $this->_cobInstance->getSessionToken(),
				'userSessionToken'	=>	$this->getSessionToken()
				);
		$restClient->doCall($data);
		
		$this->context = NULL;
		
		$this->_save();
	}
	
	public function getUserInfo()
	{
		$apiUrl = '/Login/getUserInfo';
		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);

		$data = array(
				'cobSessionToken'	=> $this->_cobInstance->getSessionToken(),
				'userSessionToken'	=>	$this->getSessionToken()
				);
				
		$restClient->doCall($data);
		$resp = $restClient->getResponseArr();
		
		return $resp;
	}
	
	public function getItemsSummary()
	{
		$apiUrl = '/DataService/getItemSummariesWithoutItemData';
		
		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);
		
		$data = array(
				'cobSessionToken'	=> $this->_cobInstance->getSessionToken(),
				'userSessionToken'	=>	$this->getSessionToken()
				);
				
		$restClient->doCall($data);
		$resp = $restClient->getResponseObj();
		
		return $resp;
	}
	
	public function getAllItems()
	{
		$apiUrl = '/DataService/getItemSummaryForItem1';
		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);
		$data = array(
				'cobSessionToken'	=> $this->_cobInstance->getSessionToken(),
				'userSessionToken'	=>	$this->getSessionToken()
				);
		
		$rawItemsSummary = $this->getItemsSummary();

		$itemsData = array();
		if (is_array($rawItemsSummary))
			foreach($rawItemsSummary as $itemSummary)
			{
				$data['itemId'] = $itemSummary->itemId;
				$data['dex.startLevel'] = 0;
				$data['dex.endLevel'] = 0;
				$data['dex.extentLevels[0]'] = 0;
				$data['dex.extentLevels[1]'] = 4;
				
				$restClient->doCall($data);
				$resp = $restClient->getResponseObj();
				
				array_push($itemsData, new Item_Item($resp));
			}
		
		return $itemsData;
	}
	
	public function getSiteForm($idx)
	{
		$apiUrl = '/SiteTraversal/getSiteInfo';
		
		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);
		
		$data = array(
				'cobSessionToken'			=> $this->_cobInstance->getSessionToken(),
				'siteFilter.reqSpecifier'	=>	16,
				'siteFilter.siteId'			=>	$idx
				);
				
		$restClient->doCall($data);
		$resp = $restClient->getResponseObj();
		
		if (isset($resp->Error))
			throw new Exception('Error Retrieving Site Form: '.$resp->Error[0]->errorDetail);
		else
		{
			return new Site_Site($resp);
		}

	}
	
	public function findSite($string)
	{
		$apiUrl = '/SiteTraversal/searchSite';
		
		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);
		
		$data = array(
				'cobSessionToken'	=> $this->_cobInstance->getSessionToken(),
				'userSessionToken'	=>	$this->getSessionToken(),
				'siteSearchString'	=>	$string
				);
				
		$restClient->doCall($data);
		$resp = $restClient->getResponseObj();
		
		return $resp;
	}
	
	// Handles removal of site
	public function removeSite($memSiteAccId)
	{
		global $cobrand, $user;
		$cobToken = $cobrand->getSessionToken();
		$usrToken = $user->getSessionToken();
		

		$remApiPath = '/SiteAccountManagement/removeSiteAccount';
		$data = array(
				'cobSessionToken' 	=> $cobToken,
				'userSessionToken' 	=> $usrToken,
				'memSiteAccId'		=> $memSiteAccId
			);
		
		$restClient = new Rest_Client(EXTD_SERVER_URL.$remApiPath);

		$restClient->doCall($data);

		$resp = $restClient->getResponseObj();
		
		unset($_SESSION['siteCache']);
		
		return $resp;
	}
	
	// Accounts
	/*
	public function getAccountSummary()
	{
		$apiUrl = 'account/summary/all​';
		
		$restClient = new Rest_Client($this->serverUrl.$apiUrl);
		echo $this->serverUrl.$apiUrl;
		
		$data = array(
				'cobSessionToken'	=> $this->_cobInstance->getSessionToken(),
				'userSessionToken'	=>	$this->getSessionToken()
				);
				
		$restClient->doCall($data);
		$resp = $restClient->getResponseObj();
		
		return $resp;
	}
	*/
	public function isLoggedIn()
	{
		if (isset($this->context->conversationCredentials->sessionToken) && $this->context->conversationCredentials->sessionToken > "")
		{
			return true;
		}
		else return false;
	}
	
	private function _loadApiInfo()
	{
		$this->serverUrl	= BASE_SERVER_URL;
	}
	
	private function _save()
	{
		$_SESSION['UserInstance']	= serialize($this);
	}

	// Prevent cloning of the instance
	private function __clone() { }
};
?>