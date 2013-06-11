<?php

	class AccountPage extends Page {

		static $db = array(
	    	'ThankYouMessage' => 'HTMLText',
	    	'RenewedMessage' => 'HTMLText'
	   	);
		
		static $has_one = array();
		static $has_many = array(
			"MembershipPrices" => "MembershipPrice",
			"RenewalPrices" => "RenewalPrice"
		);
	   	
		function getCMSFields() {
			$fields = parent::getCMSFields();

			$fields->addFieldToTab("Root.Messages", new HTMLEditorField('ThankYouMessage', 'Registration Thank You Message'));		
			$fields->addFieldToTab("Root.Messages", new HTMLEditorField('RenewedMessage', 'Account Renewal Message'));		

			return $fields;
		}
	}

	/**
	 * Controller for AccountPage
	 */
	class AccountPage_Controller extends Page_Controller {
	
		public static $allowed_actions = array ();

		public function init() {
			parent::init();
		}

		public function index() {
			if (Member::currentUser() == false) {
				$this->redirect('account/register');
			}
			else {
				$this->redirect('account/edit');
			}
		}

		/**
		 * Render an Account registration view
		 */
		public function register() {
			if (Member::currentUser() == false) {
				$data = array(
					'Title' => 'Register Account',
					'Form' => $this->RegisterForm()
				);

				return $this->customise($data)->renderWith(array('Account_register', 'Page'));
			}
			else {
				$this->redirect('account/edit');
			}
		}

		/**
		 * Render an Account edit view
		 */
		public function edit() {
			$data = array(
				'Title' => 'Edit Account',
				'Form' => $this->EditForm()
			);

			return $this->customise($data)->renderWith(array('Account_edit', 'Page'));
		}

	    public function thankyou() {
			$data = array(
				'Title' => 'Thank You',
				'Content' => $this->ThankYouMessage
			);

			return $this->customise($data)->renderWith(array('Page', 'Page'));
	    }

		function RegisterForm() {
			$MemberFields = array();
			$MemberFields[] = new FieldGroup(
	        	new HeaderField('Your account will be activated once payment is verified'),
	        	new FieldGroup(
	        		//new DropdownField("Prefix", "Title", MemberRole::$prefixTypes),
	        		DropdownField::create("Prefix")->setTitle("Title")->setSource(MemberRole::$prefixTypes),
	        		TextField::create("FirstName")->setTitle("First name"),
	        		TextField::create("Surname")->setTitle("Surname"),
	        		EmailField::create("Email")->setTitle("Email"),
	        		TextField::create("Telephone")->setTitle("Telephone"),
	        		DropdownField::create("Category")->setTitle("Category")->setSource(MemberRole::$categories),
	        		DropdownField::create("Discipline")->setTitle("Specialty")->setSource(MemberRole::$disciplineTypes),

	        		TextField::create("Address")->setTitle("Address"),
	        		TextField::create("City")->setTitle("City"),
	        		TextField::create("PostalCode")->setTitle("Postal code"),
	        		TextField::create("State")->setTitle("State")->setAttribute("title", "State"),
	        		CountryDropDownField::create("Country")->setTitle("Country"),
	        		ConfirmedPasswordField::create("Password")->setTitle("")
	        	)
	        );

			$data = Session::get("FormInfo.RegisterForm_RegisterForm.data");

			$form = new Form($this, "RegisterForm", 
				new FieldList(
					$MemberFields
				),
				new FieldList(
					new FormAction('doRegisterForm', 'Register Now') 
				),
				new RequiredFields('Prefix','FirstName','Surname','Email','Telephone','Discipline','Address','City','PostalCode','State')
			);

			if(is_array($data)) {
				$form->loadDataFrom($data);
				Session::clear("FormInfo.RegisterForm_RegisterForm.data");
				Session::save();
			}

			return $form;
		}

		/**
		 * Handle account registration.  Will set Member account as inactive, for later processing
		 */
		public function doRegisterForm($data, Form $form) {	
			if($this->checkMember($data,$form)) {
					if($member = $this->addMember($data,$form)) {

						$member->ActiveMembership = 0;		// to be activated manually by admin

				    	// TODO move these to where admin can activate user
						//$member->ActiveMembership = 1;
						//$member->RegisterdUntil = $this->RegisteredUntil(date('n'));

						$member->write();

						// TODO use a MemberPage rather than the home page
						$MemberPage = DataObject::get_one('HomePage');

						// send email to new member
						$memberEmailData = array(
							"Member" => $member,
							"MemberURL" => Director::absoluteBaseURL($MemberPage->Link())
						);
						$email = new Email();
				        $email->ss_template = 'Account_email';
						$email->populateTemplate($memberEmailData);
				        $email->subject = 'Alfred Senior account registration submitted';
				        $email->from = ($this->ContactEmail != NULL) ? $this->ContactEmail : Email::getAdminEmail();
				       	$email->to = $member->Email;
				        $email->send();	

						// member not active so cannot login
						//$member->logIn();

						// send email to admin
						$privateEmailData = array(
							"mode" => 'registered',
							"FirstName" => $member->FirstName,
							"Surname" => $member->Surname
						);
						$email = new Email();
				        $email->ss_template = 'Member_Email';
						$email->populateTemplate($privateEmailData);
				        $email->subject = 'Member Registered';
				        $email->from = $member->Email;
				       	$email->to = Email::getAdminEmail();
				        $email->send();	

						return $this->redirect("account/thankyou");
					} else {
						return $this->redirectBack();
					}
			} else {
				return $this->redirectBack();
			}
		}

		function checkMember($data, $form) {
			$Valid = true;
				      	
			$email = Convert::raw2sql($data['Email']);

			if ($member = DataObject::get_one("Member", "`Email` = '$email'"))
			{
				$form->addErrorMessage("Message","Sorry, that email address already exists. Please choose another.","bad");	
				Session::set("FormInfo.RegisterForm_RegisterForm.data", $data);
				$Valid = false;
			}		

			return $Valid;
	    }

		function addMember($data, $form) {
			$Valid = true;
				      	
			$email = Convert::raw2sql($data['Email']);

			if ($member = DataObject::get_one("Member", "`Email` = '$email'"))
			{
				$form->addErrorMessage("Message","Sorry, that email address already exists. Please choose another.","bad");	
				$Valid = false;
			}		

			if ($Valid == true)
			{
				$member = new Member();
				$form->saveInto($member);
				$member->write();

				if($group = DataObject::get_one('Group', "Code = 'members'")) { 
					$member->Groups()->add($group);
				}

				return $member;
			}
			else
			{
		        Session::set("FormInfo.RegisterForm_RegisterForm.data", $data);
				return;
			}
	    }

		/**
		 * Form for editing member details
		 */
		function EditForm() {
			$Member = Member::currentUser();
			if ($Member == false) {
				$this->redirect('account/register');
				return;
			}
			error_log("got member: " . $Member);

			$MemberFields = array();
			$MemberFields[] = new FieldGroup(
	        	new HeaderField('Update your account details'),
	        	new FieldGroup(
	        		new DropdownField('Prefix', 'Title', MemberRole::$prefixTypes, $Member->Prefix),
	        		new TextField("FirstName","First Name", $Member->FirstName),
	        		new TextField("Surname","Surname", $Member->Surname),
	        		new EmailField("Email","Email", $Member->Email),
	        		new TextField("Telephone","Telephone (eg: 61 3 1234 5678)", $Member->Telephone),
	        		new DropdownField("Category", "Category", MemberRole::$categories, $Member->Category),
	        		new DropdownField("Discipline", "Specialty", MemberRole::$disciplineTypes, $Member->Discipline),
	        		new TextField("Address", "Address", $Member->Address),
	        		new TextField("City", "City", $Member->City),
	        		new TextField("PostalCode", "Postal Code", $Member->PostalCode),
	        		new TextField("State", "State", $Member->State),
	        		new CountryDropDownField("Country", "Country", $Member->Country),
	        		new ConfirmedPasswordField("Password", "Password", $Member->Password)
	        	)
	        );

			$data = Session::get("FormInfo.RegisterForm_EditForm.data");

			$form = new Form($this, "EditForm", 
				new FieldList(
					$MemberFields
		        ),  
				new FieldList(
					new FormAction('doEditForm', 'Update Profile') 
				),
				new RequiredFields('Prefix','FirstName','Surname','Email','Telephone','Discipline','Address','City','PostalCode','State')
			);

			if(is_array($data)) {
				$form->loadDataFrom($data);
				Session::clear("FormInfo.RegisterForm_EditForm.data");
				Session::save();
			}

			return $form;
		}

		public function doEditForm($data, Form $form) {
			if($member = $this->updateMember($data,$form)) {
				$member->write();

				$data['mode'] = 'edited';

				// send email to admin
				$email = new Email();
		        $email->ss_template = 'Member_Email';
				$email->populateTemplate($data);
		        $email->subject = 'Member Updated';
		        $email->from = $data['Email'];
		       	$email->to = Email::getAdminEmail();
		        $email->send();	

				return Director::redirectBack();				
			}
			else {
				return Director::redirectBack();
			}
		}

		function updateMember($data, $form) {	
			$CurrentMember = Member::currentUser();
			$Valid = true;
				      	
			$email = Convert::raw2sql($data['Email']);

			if ($member = DataObject::get_one("Member", "`Email` = '$email' AND ID != $CurrentMember->ID")) {
				$form->addErrorMessage("Message","Sorry, that email address already exists. Please choose another.","bad");	
				$Valid = false;
			}
			
			if ($Valid == true) {
				$member = DataObject::get_by_id('Member',$CurrentMember->ID);
				$form->saveInto($member);
				$member->write();
				return $member;
			}
			else {
		        Session::set("FormInfo.RegisterForm_EditForm.data", $data);
				return;
			}
	    }

	    function renewed() {
			$data = array(
				'Title' => 'Thank You',
				'Content' => $this->RenewedMessage
			);

			return $this->customise($data)->renderWith(array('Page', 'Page'));
	    }

		function RegisteredUntil($month) {	
			switch ((int)$month) {
			    case 1:
			        $Year = date("Y");
			        break;
			    case 2:
			        $Year = date("Y");
			        break;
			    case 3:
			        $Year = date("Y");
			        break;
			    case 4:
			        $Year = date("Y");
			        break;
			    case 5:
			        $Year = date("Y");
			        break;
			    case 6:
			        //$Year = date("Y");
			    	$Year = date("Y", strtotime("+1 year"));
			        break;
			    case 7:
			        $Year = date("Y", strtotime("+1 year"));
			        break;
			    case 8:
			        $Year = date("Y", strtotime("+1 year"));
			        break;
			    case 9:
			        $Year = date("Y", strtotime("+1 year"));
			        break;
			    case 10:
			        $Year = date("Y", strtotime("+1 year"));
			        break;
			    case 11:
			        $Year = date("Y", strtotime("+1 year"));
			        break;
			    case 12:
			        $Year = date("Y", strtotime("+1 year"));
			        break;
			}

			return $Year.'-06-30';
		}
	}
	
?>