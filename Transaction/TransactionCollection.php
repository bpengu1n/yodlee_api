<?php
// TransactionCollection.php
// TransactionCollection object, created by TransactionSearch from cached
//	results retrieved from Yodlee.
// @author: Benjamin Yunker

class Transaction_TransactionCollection extends ArrayObject
{
	public function __construct($data)
	{
		$this->_transactionsData = $data;
		$this->_transactionCounter = 0;
	}
	
	// Array set overload to allow simpler append of transactions to collection
	public function offsetSet($i, $v)
	{
		foreach($v->transactions as $newTrans)
		{
			array_push($this->_transactionsData->searchResult->transactions, $newTrans);
		}
	}
	
	public function getId()
	{
		//if (!isset($this->_transactionsData) || !isset($this->_transactionsData->searchIdentifier))
		//	return false;
		
		return $this->_transactionsData->searchIdentifier->identifier;
	}
	
	public function getTransaction($idx)
	{
		// Generate Transaction_Transaction object and return, or false if non-existent.
		if (!isset($this->_transactionsData) || !is_array($this->_transactionsData->searchResult->transactions) ||
			!isset($this->_transactionsData->searchResult->transactions[$idx]))
			return false;
		
		return new Transaction_Transaction($_transactionsData->searchResult->transactions[$idx]);
	}
	
	public function getNextTransaction()
	{
		if($this->_transactionCounter >= sizeof($this->_transactionsData->searchResult->transactions) ||
			!is_array($this->_transactionsData->searchResult->transactions))
		{
			return false;		// Reached the end of loaded transactions
		}
		
		return new Transaction_Transaction($this->_transactionsData->searchResult->transactions[$this->_transactionCounter++]);
	}
	
	public function getAllTransCount()
	{
		if (!isset($this->_transactionsData))
			return false;
		
		return $this->_transactionsData->countOfAllTransaction;
	}
	
	public function getData()
	{
		return $this->_transactionsData;
	}
	
	private $_transactionsData;
	private $_transactionCounter;
	
	private function _save()
	{
		// This class will not persist across sessions currently
	}
};