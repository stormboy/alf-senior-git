<?php

class StaffProfilePage extends Page {
	
	static $defaults = array(
		'ShowInMenus' => false
	); 

	static $db = array(
		'FirstName' => 'Text',
		'LastName' => 'Text',
		'Email' => 'Text',
		'Phone1' => 'Text',
		'Phone2' => 'Text',
		'Biography' => 'Text',
		'Achievements' => 'Text',
		'OtherInformation' => 'Text',
   	);

	public static $has_one = array(
		'ProfileImage' => 'Image',
	);

	static $has_many = array(
		
	);

	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new TextField('FirstName', 'First Name'), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('LastName', 'Last Name'), 'Content');
		$fields->addFieldToTab('Root.Main', new UploadField('ProfileImage'), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('Email', 'E-mail Address'), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('Phone1', 'Primary Telephone'), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('Phone2', 'Secondary Telephone'), 'Content');

		$fields->addFieldToTab('Root.Main', new TextAreaField('Biography', 'Biography', 4), 'Content');
		$fields->addFieldToTab('Root.Main', new TextAreaField('Achievements', 'Accolades and Achievements', 4), 'Content');
		$fields->addFieldToTab('Root.Main', new TextAreaField('OtherInformation', 'Other Information', 4), 'Content');

		return $fields;
	}

}

class StaffProfilePage_Controller extends Page_Controller {
	
}

?>