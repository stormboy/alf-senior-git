<?php

class EventPage extends Page {
	
	static $defaults = array(
		'ShowInMenus' => false
	); 

	static $db = array(
		'Date' => 'Date',
		'Summary' => 'Text'
   	);
	
	static $has_many = array(
		
	);
   	

	function getCMSFields() {
		$fields = parent::getCMSFields();

		$dateField = new DateField('Date');
		$dateField->setConfig('showcalendar', true);
		$dateField->setConfig('showdropdown', true);
		$dateField->setConfig('dateformat', 'dd/MM/YYYY');
		
		$fields ->addFieldToTab('Root.Main', $dateField, 'Content');
		$fields->addFieldToTab('Root.Main', new TextAreaField('Summary', 'Summary', 4), 'Content');

		return $fields;
	}

}

class EventPage_Controller extends Page_Controller {
	
}

?>