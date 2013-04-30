<?php

class ResourceListing extends Page {
	
    static $db = array(
    );
	
	static $has_many = array(
	);

   	static $allowed_children = array('ResourcePage');

	function getCMSFields() {
      	$fields = parent::getCMSFields();
		return $fields;
   	}

}

class ResourceListing_Controller extends Page_Controller {
	public function PaginatedItems() {
	  	$doSet = DataObject::get(
			$callerClass = "ResourcePage",
			$filter = "`ParentID` = '".$this->ID."'",
			$sort = "Sort ASC"
	  	);
	    $list = new PaginatedList($doSet, $this->request);
	    $list->setPageLength(10);
	    return $list;
	}

}

?>