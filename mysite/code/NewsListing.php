<?php

class NewsListing extends Page {
	
    static $db = array(
    );
	
	static $has_many = array(
	);

   	static $allowed_children = array('NewsPage');

	function getCMSFields() {
      	$fields = parent::getCMSFields();
		//$fields->removeFieldFromTab("Root.Content.Main","Content");
		return $fields;
   	}

}

class NewsListing_Controller extends Page_Controller {
	
	public function PaginatedItems() {
	  	$doSet = DataObject::get(
			$callerClass = "NewsPage",
			$filter = "`ParentID` = '".$this->ID."'",
			$sort = "Date DESC"
	  	);
	    $list = new PaginatedList($doSet, $this->request);
	    $list->setPageLength(5);
	    return $list;
	}

}

?>