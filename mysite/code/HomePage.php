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
	public function GetHomePage(){
		return DataObject::get_one("HomePage");
	}

	function LatestNews(){
    	$page = NewsPage::get()->sort("Date", "DESC")->First();
    	//$page = DataObject::get_one("NewsPage", "", true, "Date DESC");
    	return $page;
    }
    
    function LatestEvent() {
    	$page = EventPage::get()->sort("Date", "DESC")->First();
    	return $page;
    }

    function NewsPage() {
    	return $this->GetPage("news");
    }

    function EventsPage() {
    	return $this->GetPage("events");
    }

    function RegisterPage() {
    	return $this->GetPage("account");
    }

    function StaffPage() {
    	return $this->GetPage("staff");
    }

    private function GetPage($slug) {
    	return Page::get()->filter(array("URLSegment" => $slug))->sort("ID", "DESC")->First();
    }
}