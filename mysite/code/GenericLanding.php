<?php

class GenericLanding extends Page {
	
	static $defaults = array(
		
	); 

	static $db = array(
		
   	);
   	
	
	

	function getCMSFields() {
		$fields = parent::getCMSFields();

		return $fields;
	}

}

class GenericLanding_Controller extends Page_Controller {

}

?>