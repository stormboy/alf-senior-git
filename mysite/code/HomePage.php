<?php
class HomePage extends Page {

	public static $db = array(
		'MainBlurbText' => 'Text',
	);

	public static $has_one = array(
		'MainBlurbImage' => 'Image',
		'MainBlurbURL' => 'SiteTree'
	);

	function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.MainBlurb', new TextAreaField('MainBlurbText', 'Main Blurb Text', 4));
		$fields->addFieldToTab('Root.MainBlurb', new UploadField('MainBlurbImage'));
		$fields->addFieldToTab('Root.MainBlurb', new TreeDropdownField('MainBlurbURLID','Main Blurb URL','SiteTree'));
		
		return $fields;
	}
}

class HomePage_Controller extends Page_Controller {

	function LatestNews(){
        return DataObject::get("NewsPage", "", "Date DESC", "", 1);
    }
    
    function LatestEvent() {
        return DataObject::get("EventPage", "", "Date DESC", "", 1);
    }

}