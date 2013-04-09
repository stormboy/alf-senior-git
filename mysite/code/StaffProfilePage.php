<?php

class StaffProfilePage extends Page {
	
	static $defaults = array(
		'ShowInMenus' => false
	); 

	static $db = array(
		'Name' => 'Text',
		'Email' => 'Text',
		'Phone1' => 'Text',
		'Phone2' => 'Text',
		'Biography' => 'Text',
		'Achievements' => 'Text',
		'OtherInformation' => 'Text'
   	);
	
	static $has_many = array(
		
	);

	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Name'));
		$fields->addFieldToTab('Root.Main', new TextField('Email', 'E-mail Address'));
		$fields->addFieldToTab('Root.Main', new TextField('Phone1', 'Primary Telephone'));
		$fields->addFieldToTab('Root.Main', new TextField('Phone2', 'Secondary Telephone'));

		$fields->addFieldToTab('Root.Main', new TextAreaField('Biography', 'Biography', 4));
		$fields->addFieldToTab('Root.Main', new TextAreaField('Achievements', 'Accolades and Achievements', 4));
		$fields->addFieldToTab('Root.Main', new TextAreaField('OtherInformation', 'Other Information', 4));

		return $fields;
	}

}

class StaffProfilePage_Controller extends Page_Controller {
	
}

?>