<?php

/**
 * Resource article
 */
class ResourcePage extends Page {
	
	static $defaults = array(
		'ShowInMenus' => false
	); 

	static $db = array(
		'Summary' => 'Text'
   	);
	
	static $has_one = array(
		'Image' => 'Image',
	);
   	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new UploadField('Image'));
		$fields->addFieldToTab('Root.Main', new TextAreaField('Summary', 'Summary', 4), 'Content');
		return $fields;
	}

}

class ResourcePage_Controller extends Page_Controller {
		
}

?>