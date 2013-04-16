<?php

class NewsPage extends Page {
	
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
		$dateField->setConfig('dateformat', 'dd/MM/YYYY');
		$dateField->setConfig('showdropdown', true);
		
		$fields->addFieldToTab('Root.Main', $dateField, 'Content');
		$fields->addFieldToTab('Root.Main', new TextAreaField('Summary', 'Summary', 4), 'Content');

		return $fields;
	}

}

class NewsPage_Controller extends Page_Controller {
	
}

?>