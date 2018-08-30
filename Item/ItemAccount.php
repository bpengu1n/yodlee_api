<?php
// ItemAccount.php
// Item Account object for individual account interaction
// @author: Benjamin Yunker

class Item_ItemAccount
{	
	// Overloaded to construct object from raw data
	public function __construct($data)
	{
		$this->_acctData = $data;
	}
	
	// Returns accountNumber as string
	public function getAccountType()
	{
		return $this->_acctData->acctType;
	}
	
	// Returns accountNumber as string
	public function getAccountNumber()
	{
		if (isset($this->_acctData->accountNumber))
			return $this->_acctData->accountNumber;
		else
			return false;
	}
	
	// Returns account display name as string
	public function getAccountDisplayName()
	{
		if (isset($this->_acctData->accountName))
			return $this->_acctData->accountName;
		else
			return $this->_acctData->accountDisplayName->defaultNormalAccountName;
	}
	
	// getBills - for BillPay accounts - returns false if not BillPay
	public function getBills()
	{
		if (isset($this->_acctData->bills))
			return $this->_acctData->bills;
		else // Return false if not billpay account
			return false;
	}
	
	// getPolicies - for insurance accounts - returns false if not insurance
	public function getPolicies()
	{
		if (isset($this->_acctData->insurancePolicys))
			return $this->_acctData->insurancePolicys;
		else
			return false;
	}
	
	// BALANCE ACCOUNT METHODS
	
	// getAvailableBalance - returns balance when disclosed; false otherwise.
	public function getAvailableBalance()
	{
		if (isset($this->_acctData->availableBalance))
			return $this->_acctData->availableBalance->amount;
		else
			return false;
	}
	// getCurrentBalance - returns balance when disclosed; false otherwise.
	public function getCurrentBalance()
	{
		if (isset($this->_acctData->currentBalance))
			return $this->_acctData->currentBalance->amount;
		else
			return false;
	}
	
	// CREDIT ACCOUNT METHODS
	
	public function getRunningBalance()
	{
		if (isset($this->_acctData->runningBalance))
			return $this->_acctData->runningBalance->amount;
		else
			return false;
	}
	
	public function getAvailableCredit()
	{
		if (isset($this->_acctData->availableCredit))
			return $this->_acctData->availableCredit->amount;
		else
			return false;
	}
	public function getTotalCreditLine()
	{
		if (isset($this->_acctData->totalCreditLine))
			return $this->_acctData->totalCreditLine->amount;
		else
			return false;
	}
	public function getAPR()
	{
		if (isset($this->_acctData->apr))
			return $this->_acctData->apr;
		else
			return false;
	}
	
		
	// Private class members
	private $_acctData;
	
	// Persist object in session
	private function _save()
	{
		// No persistence at the moment
	}
}