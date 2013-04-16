<?php

class StaffListing extends Page {
	
     static $db = array(
    );
	
	static $has_many = array(
		
	);

   	static $allowed_children = array('StaffProfilePage');

	function getCMSFields() {
      	$fields = parent::getCMSFields();
		return $fields;
   	}

}

class StaffListing_Controller extends Page_Controller {
	
	function Staff($Letter = 'a') {
		if (!isset($_GET['start'])) $_GET['start'] = 0;

	  	if(!is_numeric($_GET['start']) || (int)$_GET['start'] < 1) $_GET['start'] = 0;
	  	$SQL_start = (int)$_GET['start'];

	  	$doSet = DataObject::get(
			$callerClass = "StaffProfilePage",
			// $filter = "`ParentID` = '".$this->ID."' AND `LastName` like '".$Letter."%'",
			$filter = "`ParentID` = '".$this->ID."'",
			$sort = "LastName ASC",
			$join = ""
	  );

	  return $doSet ? $doSet : false;
	}

}

?>