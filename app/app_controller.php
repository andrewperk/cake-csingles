<?php

class AppController extends Controller {
  public $helpers = array('Form', 'Html', 'Session', 'PaypalIpn.Paypal');
  public $components = array('Session', 'Auth', 'Security');
  /**
   * Intializes Auth component variables.
   * 
   * Checks for different states of users: logged in, admin etc..
   */
  public function beforeFilter() {
    $this->Auth->allow('index');
    $this->Auth->logoutRedirect = array('controller'=>'pages', 'action'=>'index');
    $this->Auth->loginError = "Incorrect username/password combination.";
    $this->Auth->authError = "Please login.";
    $this->Auth->autoRedirect = FALSE;

    // Check for logged in User
    $this->set('logged_in', $this->logged_in());
    // Send current user to view
    $this->set('current_user', $this->current_user());
    // Check for an admin
    $this->set('is_admin', $this->is_admin());
		// Check for being on the login or add action
		$this->set('not_login_register', $this->not_login_register());
  }
	
	/**
	 * Paypal callback to handle what to do after a 
	 * successful subscription. 
	 * 
	 * Upon successful subscription upgrade user to a a subscriber.
	 * 
	 * @param $txnId the paypal transaction id
	 */
	function afterPaypalNotification($txnId){
		// Get the transaction	
	  $transaction = ClassRegistry::init('PaypalIpn.InstantPaymentNotification')->findById($txnId);
	  $this->log($transaction['InstantPaymentNotification']['id'], 'paypal');
	
		// check that it was complete
	  if($transaction['InstantPaymentNotification']['payment_status'] == 'Completed'){
	  	// grab the user variable that was returned from paypal and upgrade that user to subscribed
	  	$user = ClassRegistry::init('User')->findById($transaction['InstantPaymentNotification']['custom']);
			ClassRegistry::init('User')->id = $user['User']['id'];
			ClassRegistry::init('User')->saveField('subscribed', 'yes');
	  }
	  else {
	      //Oh no, better look at this transaction to determine what to do; like email a decline letter.
	  }
	} 
	

  /**
   * Checks if a user is logged in.
   * 
   * @return boolean
   */
  protected function logged_in() {
    if ($this->Auth->user()) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Returns the current user.
   * 
   * @return the current user
   */
  protected function current_user() {
    if ($this->logged_in()) {
			return $this->Auth->user();
    }
  }
  
  /**
   * Checks if an admin is logged in.
   * 
   * @return boolean
   */
  protected function is_admin() {
    if ($this->Auth->user('role') == 'admin') {
      return TRUE;
    }
    return FALSE;
  }
  
  /**
   * Checks if they are friends or self 
   * to determine if a friend link should be displayed.
   */
  protected function not_friends_or_self() {
    
  }
	
	/**
	 * Checks if the action is login or add.
	 * Dont display the login or register form that is 
	 * in the header and mid-banner if on these actions.
	 * 
	 * @return boolean false if on login or add action
	 */
	protected function not_login_register() {
		if ($this->action == 'login' || $this->action == 'add') {
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * Checks if the logged in user is not a paid subscriber.
	 * 
	 * @rturn boolean true if not a subscriber
	 */
	protected function isNotSubscribed() {
		if ($this->Auth->user('subscribed') != "yes") {
			return TRUE;
		}
		return FALSE;
	}
}