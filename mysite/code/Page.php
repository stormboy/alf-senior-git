<?php

class Page extends SiteTree {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	public static $allowed_actions = array (
	);

	public function init() {
		parent::init();

		// Note: you should use SS template require tags inside your templates 
		// instead of putting Requirements calls here.  However these are 
		// included so that our older themes still work
		Requirements::themedCSS('reset');
		Requirements::themedCSS('layout'); 
		Requirements::themedCSS('typography'); 
		Requirements::themedCSS('form'); 

		// stop Silverstripe from including its jQuery file
		Requirements::block(SAPPHIRE_DIR .'/thirdparty/jquery/jquery.js'); 

		// if ($this->FinalParent()->ClassName == 'MemberPage') {
		// 	if (Member::currentUser()) {
		// 		$Member = Member::currentUser();
		// 		$memberCheck = $Member->checkMembership($Member);

		// 		if ($memberCheck == false) {
		// 			$AccountPage = DataObject::get_one('AccountPage');
		// 			Director::redirect($AccountPage->Link().'renewal');
		// 		}
		// 	}
		// }
	}

	function ContactPage() {
		return $this->GetPage("contact");
	}

}