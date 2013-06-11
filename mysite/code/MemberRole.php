<?php

  class MemberRole extends DataExtension {

    static $db = array(
          'Prefix' => "Enum('Mr,Mrs,Miss,Ms,Dr,AProf,Prof', 'Mr')",
          'Category' => "Enum('Advanced Trainee,Fulltime Staff,VMO,Retired', 'Fulltime Staff')",
          'Discipline' => "Enum('Allergy,Asthma,Bariatric Surgery,Breast Surgery,Cardiology,Cardiothoracic Surgery,Child and Adolescent Psychiatry,Colorectal Surgery,Dermatology,Endocrinology,Gastroenterology,Gastrointestinal Surgery,General Medicine,General Surgery,Geriatric Medicine,Gynaecological Oncology,Gynaecology,Haematology,Head and Neck Surgery,Hepatology,Hyperbaric Medicine,Immunology and Allergy,Infectious Diseases,Infertility and Reproductive Medicine,Interventional Radiology,Medical Oncology,Medico-Legal,Nephrology,Neurosurgery,Nuclear Medicine,Obstetrics and Gynaecology,Occupational Medicine,Ophthalmology,Oral and Maxillofacial Surgery,Orthopaedic Surgery,Otolarnyngology,Paediatric Medicine,Paediatric Surgery,Pain Management,Plastic and Reconstructive Surgery,Psychiatry,Radiation Oncology,Rehabilitation Medicine,Reproductive Medicine,Respiratory Medicine,Rheumatology,Sleep Medicine,Sports Medicine,Urology,Vascular,Surgery','General Medicine')",
          'Telephone' => 'Varchar(255)',
          'Address' => 'Text',
          'City' => 'Varchar(255)',
          'PostalCode' => 'Varchar(255)',
          'State' => 'Varchar(255)',
          'Country' => 'Varchar(255)',
          'ActiveMembership' => 'Boolean',
          'Lapsed' => 'Boolean',
          'RegisterdUntil' => 'Date'

      ); 

    static $has_one = array(); 

    static $has_many = array();

    static $many_many = array(); 

    static $belongs_many_many = array(); 

    static $defaults = array(
         "ActiveMembership" => "0",
         "Lapsed" => "0"
    );


    public static $prefixTypes = array(
          'Mr' => 'Mr',
          'Mrs' => 'Mrs',
          'Miss' => 'Miss',
          'Ms' => 'Ms',
          'Dr' => 'Dr',
          'AProf' => 'A/Prof',
          'Prof' => 'Prof'
      );

    public static $disciplineTypes = array(
        'Allergy',
        'Asthma',
        'Bariatric Surgery',
        'Breast Surgery',
        'Cardiology',
        'Cardiothoracic Surgery',
        'Child and Adolescent Psychiatry',
        'Colorectal Surgery',
        'Dermatology',
        'Endocrinology',
        'Gastroenterology',
        'Gastrointestinal Surgery',
        'General Medicine',
        'General Surgery',
        'Geriatric Medicine',
        'Gynaecological Oncology',
        'Gynaecology',
        'Haematology',
        'Head and Neck Surgery',
        'Hepatology',
        'Hyperbaric Medicine',
        'Immunology and Allergy',
        'Infectious Diseases',
        'Infertility and Reproductive Medicine',
        'Interventional Radiology',
        'Medical Oncology',
        'Medico-Legal',
        'Nephrology',
        'Neurosurgery',
        'Nuclear Medicine',
        'Obstetrics and Gynaecology',
        'Occupational Medicine',
        'Ophthalmology',
        'Oral and Maxillofacial Surgery',
        'Orthopaedic Surgery',
        'Otolarnyngology',
        'Paediatric Medicine',
        'Paediatric Surgery',
        'Pain Management',
        'Plastic and Reconstructive Surgery',
        'Psychiatry',
        'Radiation Oncology',
        'Rehabilitation Medicine',
        'Reproductive Medicine',
        'Respiratory Medicine',
        'Rheumatology',
        'Sleep Medicine',
        'Sports Medicine',
        'Urology',
        'Vascular',
        'Surgery'
      );

    static $categories = array(
        "Advanced Trainee", 
        "Fulltime Staff", 
        "VMO", 
        "Retired"
      );

/*
    public function extraStatics( $class = null, $extension = null ) {
      return array(
        'db' => array(
          'Prefix' => "Enum('Mr,Mrs,Miss,Ms,Dr,AProf,Prof','Mr')",
          'Discipline' => "Enum('Dietitian,Pharmacist,Nurse,IndustryScientist,ResearchOfficers,MedicalPractitioner,Intensivist,Physician,Paediatrician,Surgeon,MedicalStudent','Dietitian')",
          'State' => 'Varchar(255)',
          'ESPEN' => 'Varchar(255)',
          'Address' => 'Text',
          'PostalCode' => 'Varchar(255)',
          'City' => 'Varchar(255)',
          'Telephone' => 'Varchar(255)',
          'Country' => 'Varchar(255)',
          'ActiveMembership' => 'Boolean',
          'Lapsed' => 'Boolean',
          'RegisterdUntil' => 'Date'
        )
      );
    }
  */

    public function updateCMSFields(FieldList $fields) {

      $fields->removeByName('TimeFormat');
      $fields->removeByName('DateFormat');
      $fields->removeByName('Locale');

      $fields->addFieldToTab("Root.Main", new CheckboxField('NotifyMember', 'Notify Member'));
      $fields->addFieldToTab("Root.Main", new DropdownField('Mode', 'Notify Mode', array("created" => "Created","updated"=>"Updated")));
      $fields->replaceField('RegisterdUntil',  DateField::create('RegisterdUntil', 'Registerd Until')->setConfig('showcalendar', true) );
      $fields->replaceField('Prefix', new DropdownField('Prefix', 'Prefix', MemberRole::$prefixTypes));
      $fields->replaceField('Category', new DropdownField('Category', 'Category', MemberRole::$categories));
      $fields->replaceField('Discipline', new DropdownField('Discipline', 'Specialty', MemberRole::$disciplineTypes));
    }

    function onBeforeWrite() {
      $changedFields = $this->owner->getChangedFields();
      if ($changedFields && isset($changedFields['ActiveMembership']) ) {
        $ActiveMembershipBefore = $changedFields['ActiveMembership']['before'];
      }

      if ($this->owner->ActiveMembership && ($this->owner->ActiveMembership != $ActiveMembershipBefore) )  {
        //error_log("sending activation email");
        SS_Log::log("sending activation email", SS_Log::WARN);
        try {
          $MemberPage = DataObject::get_one('HomePage');  // TODO member page instead of home
          $memberEmailData = array(
              "Member" => $this->owner,
              "MemberURL" => Director::absoluteBaseURL($MemberPage->Link())
            );

          //error_log("sending email to " . $this->owner->Email);
          SSViewer::set_theme('alfred-senior');
          $email = new Email();
          $email->setTemplate('Account_activated');
          $email->populateTemplate($memberEmailData);
          $email->subject = 'Alfred Senior Member Account';
          $email->from = Email::getAdminEmail();
          $email->to = $this->owner->Email;
          $email->send();
        }
        catch (Exception $e) {
          error_log('Caught exception while sending email: ',  $e->getMessage(), "\n");
          SS_Log::log("Caught exception while sending email: " . $e->getMessage(), SS_Log::WARN);
        }
      }

      return parent::onBeforeWrite();
    }

      //SSViewer::set_theme('alfred-senior');
      /*
      if (isset($_POST['NotifyMember'])) {
        $data = $_POST;
        $data['MemberPassword'] = $_POST['Password']['_Password'];

        $email = new Email();
        $email->ss_template = 'NotifyMember_Email';
        $email->populateTemplate($_POST);
        $email->subject = 'Alfred Senior Member Email';
        $email->from = Email::getAdminEmail();
        $email->to = $_POST['Email'];
        $email->send(); 
      }
      */

    function checkMembership($Member) {
      $Group = DataObject::get_one('Group', "Code = 'members'");

      if($Member->inGroup($Group->ID)){
          if (strtotime($Member->RegisterdUntil) <= time()) {

              $lapseddate = strtotime(date("Y-m-d", strtotime($Member->RegisterdUntil)) . " +2 month");

              $Member->ActiveMembership = 0;
              
              if ($lapseddate <= time()) {
                  $Member->Lapsed = 1;
                  $Member->addToGroupByCode('lapsed');
                  $Member->Groups()->remove($Group->ID);
              }

              $Member->write();

              return false;
          } else {
              return true;
          }
      } else{
          //Security::permissionFailure();
        return false;
      }
    }

    function approveMembership() {
      //$member->ActiveMembership = 1;
      //$member->RegisterdUntil = $this->RegisteredUntil(date('n'));
    }    
  }

?>