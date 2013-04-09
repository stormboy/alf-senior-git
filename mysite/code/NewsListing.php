<?php

class NewsListing extends Page {
	
     static $db = array(
    );
	
	static $has_many = array(
		
	);

   	static $allowed_children = array('NewsPage','Page');

	function getCMSFields() {
      	$fields = parent::getCMSFields();
		//$fields->removeFieldFromTab("Root.Content.Main","Content");
		return $fields;
   	}

}

class NewsListing_Controller extends Page_Controller {

	
	function NewsArticles() {
		if (!isset($_GET['start'])) $_GET['start'] = 0;

	  	if(!is_numeric($_GET['start']) || (int)$_GET['start'] < 1) $_GET['start'] = 0;
	  	$SQL_start = (int)$_GET['start'];

	  	$doSet = DataObject::get(
			$callerClass = "NewsPage",
			$filter = "`ParentID` = '".$this->ID."'",
			$sort = "Date DESC",
			$join = "",
			$limit = "{$SQL_start},5"
	  );

	  return $doSet ? $doSet : false;
	}
	
	



}

?>