<?php
// SiteCollection.php
// SiteCollection object
// @author: Benjamin Yunker

class Site_SiteCollection
{
	public function __construct($data)
	{
		$this->_sitesData = $data;
		$this->_siteCounter = 0;
	}
	
	public function getSite($idx)
	{
		// Generate Site_Site object and return, or false if non-existent.
	}
	
	public function getNextSite()
	{
		if($this->_siteCounter == sizeof($this->_sitesData) ||
			!is_array($this->_sitesData))
			return false;		// Reached the end of found sites
		else
			return new Site_Site($this->_sitesData[$this->_siteCounter++]);
	}
	
	// Return persisted site, or false if none in session
	public function recallSite()
	{
		if (isset($_SESSION['siteCache']))
			return unserialize($_SESSION['siteCache']);
		else
			return false;
	}
	
	private $_sitesData;
	private $_siteCounter;
	
	private function _save()
	{
		// This class will not persist across sessions; Site_Site will, however.
	}
};