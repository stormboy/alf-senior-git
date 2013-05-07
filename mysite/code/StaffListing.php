<?php

class StaffListing extends Page {
	
     static $db = array(
    );
	
	static $has_many = array(
		'StaffMembers' => 'StaffMember'
	);

   	//static $allowed_children = array('StaffProfilePage');

	function getCMSFields() {
		$fields = parent::getCMSFields();

		// create a config object for the grid field
		$gridFieldConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableHeader(),
			new GridFieldDataColumns(),
			new GridFieldPaginator(20),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm(),
			new GridFieldBulkImageUpload(),
			new GridFieldSortableRows('SortOrder')
		);
		// $gridFieldConfig->addComponent(new GridFieldFilter()); // add search filter to grid field
		// $gridFieldConfig->addComponent(new GridFieldDefaultColumns()); // show default columns
		// $gridFieldConfig->addComponent(new GridFieldAction_Delete());  // add a delete button
		// $gridFieldConfig->addComponent(new GridFieldAction_Edit());  // add an edit button

		// we also have to define a template for the 'edit'/'add' window:
		// $gridFieldConfig->addComponent($gridFieldForm = new GridFieldPopupForms());		
		// $gridFieldForm->setTemplate('CMSGridFieldPopupForms');

		$itemsInGrid = DataList::create("StaffMember"); // get a list of object you want to show

		$gridField = new GridField("StaffMembers", "Staff in this directory", $this->StaffMembers(), $gridFieldConfig);

		$fields->addFieldToTab("Root.Staff", $gridField); // add the grid field to a tab in the CMS			

		return $fields;
   	}

	public function onBeforeDelete() {
        $CurrentVal = $this->get_enforce_strict_hierarchy();
        $this->set_enforce_strict_hierarchy(false);
         
        parent::onBeforeDelete();
         
        $this->set_enforce_strict_hierarchy($CurrentVal);
    }   
}


/**
 * controller for StaffListing
 */
class StaffListing_Controller extends Page_Controller {
	//Allow our 'show' function as a URL action
    static $allowed_actions = array(
        'show', 'vcard'
    );

	function Staff() {
		if (!isset($_GET['letter'])) $_GET['letter'] = 'a';
	  	$Letter = $_GET['letter'];

	  	$doSet = DataObject::get(
			$callerClass = "StaffMember",
			$filter = "`ParentID` = '".$this->ID."' AND `LastName` like '".$Letter."%'",
			$sort = "LastName ASC"
		);

		return $doSet ? $doSet : false;
	}

	function StaffPages() {
		if (!isset($_GET['letter'])) $_GET['letter'] = 'a';
	  	$Letter = $_GET['letter'];

	  	$doSet = DataObject::get(
			$callerClass = "StaffProfilePage",
			$filter = "`ParentID` = '".$this->ID."' AND `LastName` like '".$Letter."%'",
			$sort = "LastName ASC"
		);

		return $doSet ? $doSet : false;
	}

	function Alphabet() {
		if (!isset($_GET['letter'])) $_GET['letter'] = 'a';
	  	$Letter = $_GET['letter'];
		$alphabet = array();
		$C = 'A';
		$c = 'a';
		while ($C < 'Z') {
			$current = ($c == $Letter);
			array_push( $alphabet, array("upper" => $C, "lower" => $c, "current" => $current) );
			++$C;
			++$c;
		}
		$current = ($c == $Letter);
		array_push( $alphabet, array("upper" => $C, "lower" => $c, "current" => $current) );

		return new ArrayList($alphabet);

	}

    /**
     * Get the current staffMember from the URL, if any
     */
    public function getStaffMember() {
        $Params = $this->getURLParams();
         
        if(is_numeric($Params['ID']) && $StaffMember = DataObject::get_by_id('StaffMember', (int)$Params['ID'])) {
            return $StaffMember;
        }
    }
     
    /**
     * Displays the StaffMember detail page, using StaffPage_show.ss template
     */
    function show() {       
        if($StaffMember = $this->getStaffMember()) {
            $Data = array(
                'StaffMember' => $StaffMember
            );
             
            //return our $Data array to use on the page
            return $this->Customise($Data);
        }
        else {
            //Staff member not found
            return $this->httpError(404, 'Sorry that member of staff could not be found');
        }
    }

    function vcard() {       
        if($StaffMember = $this->getStaffMember()) {
            $Data = array(
                'StaffMember' => $StaffMember
            );
            $this->getResponse()->addHeader("Content-Type", "text/vcard");
            //return our $Data array to use on the page
            return $this->renderWith("VCard");
        }
        else {
            //Staff member not found
            return $this->httpError(404, 'Sorry that member of staff could not be found');
        }
    }

	//Return our custom breadcrumbs
    public function Breadcrumbs() {
         
        //Get the default breadcrumbs
        $Breadcrumbs = parent::Breadcrumbs();
         
        if($StaffMember = $this->getStaffMember()) {
            //Explode them into their individual parts
            $Parts = explode(">", $Breadcrumbs);
     
            //Count the parts
            $NumOfParts = count($Parts);
             
            //Change the last item to a link instead of just text
            $Parts[$NumOfParts-1] = ('<a href="' . $this->Link() . '">' . $Parts[$NumOfParts-1] . '</a>');
             
            //Add our extra piece on the end
            $Parts[$NumOfParts] = $StaffMember->Name(); 
     
            //Return the imploded array
            $Breadcrumbs = implode(" > ", $Parts);           
        }
 
        return $Breadcrumbs;
    }   
}

?>