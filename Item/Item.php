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
		return $this->_itemData->siteId;
	}
	
	public function getItemName()
	{ 
		if (is_object($this->_itemData))
			return $this->_itemData->itemDisplayName;
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