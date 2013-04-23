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
	
	function Staff() {
		if (!isset($_GET['letter'])) $_GET['letter'] = 'a';

	  	$Letter = $_GET['letter'];

	  	$doSet = DataObject::get(
			$callerClass = "StaffProfilePage",
			$filter = "`ParentID` = '".$this->ID."' AND `LastName` like '".$Letter."%'",
			//$filter = "`ParentID` = '".$this->ID."'",
			$sort = "LastName ASC"
		);

		return $doSet ? $doSet : false;
	}

	function Alphabet() {
		if (!isset($_GET['letter'])) $_GET['letter'] = 'a';
	  	$Letter = $_GET['letter'];
		$alphabet = array();
		$C = 'A';
		$c = 'a';
		while ($C < 'Z') {
			$current = ($c == $Letter);
			array_push( $alphabet, array("upper" => $C, "lower" => $c, "current" => $current) );
			++$C;
			++$c;
		}
		$current = ($c == $Letter);
		array_push( $alphabet, array("upper" => $C, "lower" => $c, "current" => $current) );

		return new ArrayList($alphabet);

	}

}

?>