<?php
class StaffMember extends DataObject
{
	static $db = array (
		'Honorific' => 'Varchar(255)',
		'FirstName' => 'Varchar(255)',
		'LastName' => 'Varchar(255)',
		'Email' => 'Varchar(255)',
		'Phone1' => 'Varchar(255)',
		'Phone2' => 'Varchar(255)',
		'Biography' => 'Text',
		'Achievements' => 'Text',
		'OtherInformation' => 'Text',
	);

	// relations
	static $has_one = array (
		'ProfileImage' => 'Image',
		'Parent' => 'StaffListing'
	);

	// Fields to show in the DOM table
    static $summary_fields = array(
		'Honorific' => 'Title',
        'FirstName' => 'FirstName',
        'LastName' => 'LastName',
        'Thumbnail' => 'Image',
		'Email' => 'E-mail Address',
		'Phone1' => 'Primary Telephone',
		'Phone2' => 'Secondary Telephone',
    );

    static $searchable_fields = array( 
		'FirstName',
		'LastName'
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		// $fields->removeByName('SortOrder');
		$fields->removeByName('ParentID');
		return $fields;
	}

	public function Title() {
		return $this->Honorific . " " . $this->Name();
	}

	public function Name() {
		return $this->FirstName . " " . $this->LastName;
	}

	public function Link() {
		if($StaffPage = $this->Parent()) {
			$Action = 'show/' . $this->ID;
			return $StaffPage->Link($Action);
		}
	}

	public function VCardLink() {
		if($StaffPage = $this->Parent()) {
			$Action = "vcard/" . $this->ID . ".vcf";
			return $StaffPage->Link($Action);
		}
	}

	//Return the Name as a menu title
    public function MenuTitle() {
		return $this->Name();
	} 

	public function getThumbnail() {
		if ($this->ProfileImage()->ID) {
			//return $this->ProfileImage(); 
			return $this->ProfileImage()->SetHeight(40); 
			//return $this->ProfileImage()->CMSThumbnail();  
		}
		else {
			return null;
		}
	}

	public function LinkingMode() {
        //Check that we have a controller to work with and that it is a StaffPage
        if(Controller::CurrentPage() && Controller::CurrentPage()->ClassName == 'StaffListing') {
            //check that the action is 'show' and that we have a StaffMember to work with
            if(Controller::CurrentPage()->getAction() == 'show' && $StaffMember = Controller::CurrentPage()->getStaffMember()) {
                //If the current StaffMember is the same as this return 'current' class
                return ($StaffMember->ID == $this->ID) ? 'current' : 'link';
            }
        }
    }
}

class StaffMember_Controller extends ContentController {

   static $allowed_actions = array("show");

   function show(){

      $ID = Convert::raw2sql(Director::urlParam("ID")); 
      if (is_numeric($ID)){ 
         $item = DataObject::get_by_id("StaffMember", $ID); 
      } 
      else { 
         $item = DataObject::get_one("StaffMember", "URLSegment = '{$ID}'"); 
      } 
      if ($item){ 
         //$staffMember = $this->customise($item); 
         $staffMember = $this->customise($item)->renderWith(array("StaffMember_show","Page"));
         return $staffMember;
      } 
      else return ErrorPage::response_for(404); 
   } 
}