<?php
// TransactionSearch.php
// TransactionSearch object to perform operations for Transaction Searches
//	on Yodlee item accounts.
// @author: Benjamin Yunker

class Transaction_TransactionSearch
{	
	// Overloaded to construct object from raw data
	public function __construct()
	{
			
	}
	
	public function doSearchRequest($acctId, $fromDate, $toDate, $type='all', 
									$startNum=1, $endNum=500, $lowerLim=0, 
									$upperLim=500, $input=null, $ignoreInput='true', 
									$currency='USD', $splitType='ALL_TRANSACTION')
	{
		global $cobrand, $user;
		$apiUrl = "/TransactionSearchService/executeUserSearchRequest";
		
		$data = array(
					'cobSessionToken'												=>	$cobrand->getSessionToken(),
					'userSessionToken'												=>	$user->getSessionToken(),
					'transactionSearchRequest.searchFilter.itemAccountId.identifier'=>	$acctId,
					'transactionSearchRequest.containerType'						=>	$type,
					'transactionSearchRequest.higherFetchLimit'						=> 	$upperLim,
					'transactionSearchRequest.lowerFetchLimit'						=> 	$lowerLim,
					'transactionSearchRequest.resultRange.endNumber'				=>	$endNum,
					'transactionSearchRequest.resultRange.startNumber'				=>	$startNum,
					'transactionSearchRequest.searchClients.clientId'				=>	1,
					'transactionSearchRequest.searchClients.clientName'				=>	'DataSearchService',
					'transactionSearchRequest.userInput'							=>	$input,
					'transactionSearchRequest.ignoreUserInput'						=>	$ignoreInput,
					'transactionSearchRequest.searchFilter.currencyCode'			=>	$currency,
					'transactionSearchRequest.searchFilter.postDateRange.fromDate'	=>	$fromDate,
					'transactionSearchRequest.searchFilter.postDateRange.toDate'	=>	$toDate,
					'transactionSearchRequest.searchFilter.transactionSplitType'	=>	$splitType,
					'transactionSearchRequest.searchFilter.itemAccountId.identifier'=>	$acctId
				);

		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);

		$restClient->doCall($data);
		
		$resp = $restClient->getResponseObj();
		
		if (isset($resp->Error))
			throw new Exception('Error In Transaction Search: '.$this->_context->Error[0]->errorDetail);
		
		$this->_rawData = $resp;
		$this->_collection = new Transaction_TransactionCollection($this->_rawData);
		
		return $this->_collection;
	}
	
	public function continueSearchRequest($startNum, $endNum)
	{
		global $cobrand, $user;
		$apiUrl = "/TransactionSearchService/getUserTransactions";
		
		$data = array(
					'cobSessionToken'									=>	$cobrand->getSessionToken(),
					'userSessionToken'									=>	$user->getSessionToken(),
					'searchFetchRequest.searchIdentifier.identifier'	=>	$this->_collection->getId(),
					'searchFetchRequest.searchResultRange.startNumber'	=>	$startNum,
					'searchFetchRequest.searchResultRange.endNumber'	=>	$endNum
				);

		$restClient = new Rest_Client(EXTD_SERVER_URL.$apiUrl);

		$restClient->doCall($data);
		
		$resp = $restClient->getResponseObj();
		
		if (isset($resp->Error))
			throw new Exception('Error In Transaction Search: '.$this->_context->Error[0]->errorDetail);
		
		// print_r($resp);
		
		return $resp;
	}
		
	// Private class members
	private $_rawData;
	private $_collection;
}