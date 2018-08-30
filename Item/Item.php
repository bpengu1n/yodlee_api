<?php
// Item.php
// Item object
// @author: Benjamin Yunker

class Item_Item
{	
	// Overloaded to construct object from raw data
	public function __construct($data)
	{
		// NOTE: for certain accounts _itemData is not populated (insurance, so far..). Figure out better way to handle this
		$this->_itemData = $data;
	}
	
	public function getId()
	{
		return $this->_itemData->itemId;
	}
	
	public function getMemSiteAccId()
	{
		if (isset($this->_itemData->memSiteAccId))
			return $this->_itemData->memSiteAccId;
		else
			return false;
	}
	
	public function getItemName()
	{ 
		if (is_object($this->_itemData))
			return $this->_itemData->itemDisplayName;
	}
	
	public function getAllTransactions($acctId, $fromDate, $toDate)
	{
		$ts = new Transaction_TransactionSearch();
		// Initial search parameters for full transaction retrieval
		$startNum = 1;
		$endNum = 500;
		
		$transColl = $ts->doSearchRequest($acctId, $fromDate, $toDate);
		
		$count = floor($transColl->getAllTransCount()/500)+1;
		
		
		for ($tsIter = 1; $tsIter < $count; $tsIter++)
		{
			// Increment parameters
			$startNum += 500; 
			$endNum += 500;
			
			// Append next page of transactions
			$transColl[] = $ts->continueSearchRequest($startNum, $endNum);
		}

		//  return HANDLED_$TRANS
		return $transColl;
	}
	
	public function getAllAccounts()
	{
		$itemAccts = array();
		if (is_object($this->_itemData))
		{
			foreach ($this->_itemData->itemData->accounts as $account)
			{
				array_push($itemAccts, new Item_ItemAccount($account));
				
			}
		}
		// Build array of ItemAccount and return
		return $itemAccts;
	}
	
		
	// Private class members
	private $_itemData;
	
	// Persist object in session
	private function _save()
	{
		// No persistence at the moment
	}
}