<?php
// Transaction.php
// Transaction object created from TransactionCollection, containing
//	methods to retrieve individual transaction data.
// @author: Benjamin Yunker

class Transaction_Transaction
{	
	// Overloaded to construct object from raw data
	public function __construct($data)
	{
		$this->_transactionData = $data;
	}
	
	public function getId()
		{ return (!isset($this->_transactionData->viewKey)) 				? false : $this->_transactionData->viewKey->transactionId; }
	
	public function getParentAccountName()
		{ return (!isset($this->_transactionData->account)) 				? false : $this->_transactionData->account->accountName; }
	
	public function getParentAccountBalance()
		{ return (!isset($this->_transactionData->account->accountBalance)) ? false : $this->_transactionData->account->accountBalance->amount; }
	
	public function getTransactionTypeId()
		{ return (!isset($this->_transactionData->transactionTypeId)) 		? false : $this->_transactionData->transactionTypeId; }
	
	public function getTransactionDate()
		{ return (!isset($this->_transactionData->transactionDate)) 		? false : $this->_transactionData->transactionDate; }
		
	public function getPostDate()
		{ return (!isset($this->_transactionData->postDate)) 				? false : $this->_transactionData->postDate; }
	
	public function getDescription()
		{ return (!isset($this->_transactionData->description)) 			? false : $this->_transactionData->description->description; }
	
	public function getCategoryId()
		{ return (!isset($this->_transactionData->category)) 				? false : $this->_transactionData->category->categoryId; }
	
	public function getCategoryName()
		{ return (!isset($this->_transactionData->category)) 				? false : $this->_transactionData->category->categoryName; }
	
	public function getAmount() 
		{ return (!isset($this->_transactionData->amount)) 					? false : $this->_transactionData->amount->amount; }
	
	public function getCurrencyCode() 
		{ return (!isset($this->_transactionData->amount)) 					? false : $this->_transactionData->amount->currencyCode; }
	
	public function getStatusId() 
		{ return (!isset($this->_transactionData->status)) 					? false : $this->_transactionData->status->statusId; }
	
	public function getStatus() 
		{ return (!isset($this->_transactionData->status)) 					? false : $this->_transactionData->status->description; }
	
	public function getCheckNumber() 
		{ return (!isset($this->_transactionData->checkNumber->checkNumber))? false : $this->_transactionData->checkNumber->checkNumber; }
		
	// Private class members
	private $_transactionData;
	
	// Persist object in session
	private function _save()
	{
		// No persistence necessary
	}
}