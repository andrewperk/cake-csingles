<?php

class UsersController extends AppController {
  public $helpers = array('Friend', 'Text');
  public $paginate = array(
    'limit'=>'10'
  );
	public $components = array('Email', 'Search.Prg');
	public $presetVars = array(
		array('field'=>'search_gender', 'type'=>'value'),
		array('field'=>'search_state', 'type'=>'value'),
		array('field'=>'search_name', 'type'=>'like'),
		//array('field'=>'search_email)', 'type'=>'like'),
		array('field'=>'search_country', 'type'=>'like')
	);
  
  /**
   * Initialize the pages that are allowed by the auth 
   * component. 
   *
   * Sets the user model for hashing.
   * 
   * Protects certain pages from access that have their own redirect
   * location and flash message, thats why its not done via Auth:allow.
   */
  public function beforeFilter() {
    parent::beforeFilter();
	$this->Auth->deny('index');
    $this->Auth->allow('add', 'view', 'resend_password');
    
    // If registering or editing user use model for password hashing.
    if ($this->action == 'add' || $this->action == 'edit') {
      $this->Auth->authenticate = $this->User;
    }
    
    //  Protect the delete action: only admins
    if ($this->action == 'delete') {
      if (!$this->is_admin()) {
        $this->redirect(array('controller'=>'pages', 'action'=>'index'));
      }
    }
    
    // Protect profile page: must be logged in
    if ($this->action == 'account') {
      if (!$this->logged_in()) {
        $this->redirect(array('controller'=>'pages', 'action'=>'index'));
      }
    }
    
    // Protect send_friend_request: must be logged in and subscribed
    if ($this->action == 'send_friend_request') {
    	if ($this->isNotSubscribed()) {
        $this->Session->setFlash('You need to upgrade your account to contact members.', 'default', array('class'=>'error'));
        $this->redirect(array('action'=>'upgrade'));
      }
      if (!$this->logged_in()) {
        $this->Session->setFlash('Please login to add friends', 'default', array('class'=>'error'));
        $this->redirect(array('action'=>'login'));
      }
    }
    
    // Protect accept_friend_request: must be logged in
    if ($this->action == 'accept_friend_request') {
    	if ($this->isNotSubscribed()) {
        	$this->Session->setFlash('You need to upgrade your account to contact members.', 'default', array('class'=>'error'));
        	$this->redirect(array('action'=>'upgrade'));
    	}
      if (!$this->logged_in()) {
        $this->Session->setFlash('Please login to approve friends', 'default', array('class'=>'error'));
        $this->redirect(array('action'=>'login'));
      }
    }
    
    // Protect friend_requests: must be logged in
    if ($this->action == 'friend_requests') {
    	if ($this->isNotSubscribed()) {
        $this->Session->setFlash('You need to upgrade your account to contact members.', 'default', array('class'=>'error'));
        $this->redirect(array('action'=>'upgrade'));
      }
      if (!$this->logged_in()) {
        $this->redirect(array('controller'=>'pages', 'action'=>'index'));
      }
    }
    
    // Protect friends: must be logged in and subscribed
    if ($this->action == 'friends') {
    	if ($this->isNotSubscribed()) {
        $this->Session->setFlash('You need to upgrade your account to have friends.', 'default', array('class'=>'error'));
        $this->redirect(array('action'=>'upgrade'));
      }
      if (!$this->logged_in()) {
        $this->redirect(array('action'=>'login'));
      }
    }
	
		// Protect deleting friends: must be logged in and subscribed
		if ($this->action == 'delete_friend') {
			if ($this->isNotSubscribed()) {
	        $this->Session->setFlash('You need to upgrade your account to contact members.', 'default', array('class'=>'error'));
	        $this->redirect(array('action'=>'upgrade'));
	    }
			if (!$this->logged_in()) {
				$this->redirect(array('action'=>'login'));
			}
		}

		if ($this->action == 'upgrade') {
			$this->set('is_not_subscribed', $this->isNotSubscribed());
		}
  }
  
  /**
   * Displays all users. 
	 * 
	 * Also allows searching of users. Search has priority.
	 * Otherwise it defaults to show all users.
	 * 
   */
  public function index() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->User->parseCriteria($this->passedArgs);
		$this->set('users', $this->paginate());
		$this->set('title_for_layout', 'Canary Singles - Search Members');
	}
  
  /**
   * Register a user. 
   */
  public function add() {
    if (!empty($this->data)) {
      if ($this->User->save($this->data)) {
        
				// Send Email
				$this->Email->to = $this->data['User']['email'];
				$this->Email->from = "Canary Singles <support@canarysingles.com>";
				$this->Email->subject = "Welcome to Canary Singles";
				$this->Email->template = "register_email";
				$this->Email->sendAs = "text";
				
				$newUser = array(
					'username'=>$this->data['User']['username'],
					'password'=>$this->data['User']['password_confirmation']
				);
				
				$this->set('newUser', $newUser);
				$this->Email->send();
				
        $this->Session->setFlash('Registration Successful. <br /><br /> You are now a member of Canary Singles. <br /><br /> Now you can login, create your profile and search for other Canaries.

You will receive a confirmation email with your account details.
        ', 'default', array('class'=>'success'));
        $this->redirect(array('action'=>'login'));          
      }
      else {
        $this->Session->setFlash('Please correct the errors below:', 'default', array('class'=>'error'));
      }
    }
    $this->set('title_for_layout', 'Canary Singles - Register');
  }
  
  /**
   * Displays a single user.
   *
   * @param id the users id to display
   */
  public function view($id = NULL) {
    $user = $this->User->read(NULL, $id);
    if (!empty($id) && !empty($user)) {
      $this->set('user', $user);
    }
    else {
      $this->Session->setFlash('That user does not exist.', 'default', array('class'=>'error'));
      $this->redirect(array('controller'=>'pages', 'action'=>'index'));
    }
    $this->set('title_for_layout', 'Canary Singles');
  }
  
  /**
   * Deletes a single user.
   *
   * @param id the users id to delete
   */
  public function delete($id = NULL) {
    if (!empty($id) && $this->User->delete($id)) {
      $this->Session->setFlash('The user has been deleted.', 'default', array('class'=>'success'));
      $this->redirect(array('action'=>'index'));
    }
    else {
      $this->Session->setFlash('That user does not exist.', 'default', array('class'=>'error'));
      $this->redirect(array('action'=>'index'));
    }
  }
  
  /**
   * Logs a user in.
   * Gives custom log in flash message and 
   * redirects if alread logged in.
   */
  public function login() {
    // Enable a flash message after a successful login
    // Check if user could be logged in and set flash message if so
    if ($this->Auth->login($this->data)) {
      $this->Session->setFlash('Thanks for logging in.', 'default', array('class'=>'success'));
      $this->redirect(array('action'=>'account'));
    }
    // If user is already logged in redirect
    if ($this->Auth->user()) {
      $this->Session->setFlash('You\'re already logged in.', 'default', array('class'=>'success'));
      $this->redirect(array('action'=>'index'));
    }
    $this->set('title_for_layout', 'Canary Singles - Login');
  }
  
  /**
   * Logs a user out.
   */
  public function logout() {
    // Enable a flash message after logging out
    if ($this->Auth->user()) {
      $this->Session->setFlash('You are now logged out', 'default', array('class'=>'success'));
      $this->redirect($this->Auth->logout());
    }    
  }
  
  /**
   * Users profile to edit information.
   */
  public function account() {
    // Send user to view for personalizing
    $this->set('user', $this->User->read(NULL, $this->Auth->user('id')));
    // The logged in user to edit
    $this->User->id = $this->Auth->user('id');
    
    // Prepopulate the form with logged in user data
    if (empty($this->data)) {
      $this->data = $this->User->read();
      $this->data['User']['password'] = NULL;
    }
    // Save user
    else {
      if ($this->User->save($this->data)) {
        $this->Session->setFlash('Your account has been updated.', 'default', array('class'=>'success'));
        $this->redirect(array('action'=>'view', $this->Auth->user('id')));
      }
      // There was an error 
      else {
        $this->Session->setFlash('Please correct the errors below:', 'default', array('class'=>'error'));
      }
    }
    $this->set('title_for_layout', 'Canary Singles - Your Account');
  }
  
  /**
   * Display logged in users friends.
   */
  public function friends() {
    $user_id = $this->Auth->user('id');
    $friends = $this->User->get_friends($user_id);
		$this->set('title_for_layout', 'Canary Singles - Friends');
    $this->set('friends', $friends);
  }
  
  /**
   * Sends friend request and saves opposite relationship.
   *
   * @param friend_id the id of the person the user wants to be friends with
   */
  public function send_friend_request($friend_id) {
    if ($friend_id) {
      $user_id = $this->Auth->user('id');
			
			// Make sure the friend being requested is a paid subscriber
			if ($this->friendIsNotSubscribed($friend_id)) {
				$this->Session->setFlash('Friendships can only occur between premium paid members.', 'default', array('class'=>'error'));
				$this->redirect(array('controller'=>'chirps', 'action'=>'chirp', $friend_id));
			}
			
      // Cant be friends with their self
      if ($friend_id == $user_id) {
        $this->Session->setFlash('You can\'t be friends with yourself.', 'default', array('class'=>'error'));
        $this->redirect(array('action'=>'index'));
      }
      // Make sure they aren't already friends
      $friend = $this->User->UsersUser->find('first', array('conditions'=>array('user_id'=>$user_id, 'friend_id'=>$friend_id)));
      if (!empty($friend))
      {
        $this->Session->setFlash('You are or are awaiting to be friends with that user.', 'default', array('class'=>'error'));
        $this->redirect(array('action'=>'index'));
      }
      // Add friend
      if ($this->User->create_friend_request($user_id, $friend_id)) {
      	// Send recipent of the friend request an email letting them know they 
      	// have a friend request
      	$recipient = $this->User->read(null, $friend_id);
      	$from = $this->User->read(null, $user_id);
      	
		$this->Email->to = $recipient['User']['email'];
		$this->Email->from = "Canary Singles <support@canarysingles.com>";
		$this->Email->subject = $from['User']['username']." has sent you a friend request";
		$this->Email->template = "friend_request";
		$this->Email->sendAs = "text";
		
		$userData = array(
			'username'=>$recipient['User']['username'],
			'from_username'=>$from['User']['username']
		);
		
		$this->set('userData', $userData);
		$this->Email->send();
      	
        $this->Session->setFlash('Friend Request Sent', 'default', array('class'=>'success'));
        $this->redirect(array('action'=>'index'));
      }
    }
  }
  
  /**
   * Accepts a friend request.
   * 
   * @param user_id the id of the person who wants to be friends
   */
  public function accept_friend_request($friend_id) {
    if ($friend_id) {
      $user_id = $this->Auth->user('id');
      if ($this->User->accept_friend_request($user_id, $friend_id)) {
        $this->Session->setFlash('Friend Accepted', 'default', array('class'=>'success'));
        $this->redirect(array('action'=>'friends'));
      }
    }
  }
  
  /**
   * Show friend requests for the logged in user.
   */
  public function friend_requests() {
    $user_id = $this->Auth->user('id');
    $requests = $this->User->get_friend_requests($user_id);
    $this->set('requests', $requests);
  }
  
  /**
   * Delete a friend.
   * 
   * @param friend_id the id of the friend to delete
   */
  public function delete_friend($friend_id) {
  	// If no friend_id provided give error
  	if ($friend_id) {
	  	$user_id = $this->Auth->user('id');
			// If successfully removed friendship
			if ($this->User->delete_friend($user_id, $friend_id)) {
				$this->Session->setFlash('Friend removed', 'default', array('class'=>'success'));
		   	$this->redirect(array('action'=>'friends'));
			}
			// If something went wrong and could not remove friendship
			else {
				$this->Session->setFlash('Friend could not be removed', 'default', array('class'=>'error'));
		   	$this->redirect(array('action'=>'friends'));
			}
		}
		else {
			$this->Session->setFlash('Invalid friend.', 'default', array('class'=>'error'));
		   	$this->redirect(array('action'=>'friends'));
		}
  }
	
	/**
	 * Allows users to upgrade their account to be a 
	 * paying subscriber.
	 * 
	 */
	public function upgrade() {
		$this->set('title_for_layout', 'Canary Singles - Upgrade To Premium Membership');
	}
	
	/**
	 * Send user email with username and new password.
	 */
	public function resend_password() {
		if (!empty($this->data)) {
			// Validate Email address and make sure a user has this email
			if ($this->User->validate_email($this->data['User']['email']) && 
			    $this->User->find_email_match($this->data['User']['email'])) {
			  
				// Find the matched user by email address
				$matchedUser = $this->User->findByEmail(strtolower($this->data['User']['email']));
				
				// If found user send email
				if (!empty($matchedUser)) {
					// Set the user to update their new password
					$this->User->id = $matchedUser['User']['id'];
					
					// Generate new password and save it
					$generated_password = $this->User->generate_random_password();
					$this->User->saveField('password', $generated_password);
					
					// Send username and new password email
					$this->Email->to = $matchedUser['User']['email'];
					$this->Email->from = "Canary Singles <support@canarysingles.com>";
					$this->Email->subject = "Your Username and Password Reset Instructions";
					$this->Email->template = "resend_password";
					$this->Email->sendAs = "text";
					
					$userData = array(
						'username'=>$matchedUser['User']['username'],
						'newPassword'=>$generated_password
					);
					
					$this->set('user', $userData);
					$this->Email->send();
					
					// Give flash message and redirect
					$this->Session->setFlash('Reset instructions have been sent to the email address you entered.', 'default', array('class'=>'success'));
					$this->redirect(array('controller'=>'pages', 'action'=>'index'));
				}
			}
			else {
				$this->Session->setFlash('Incorrect Email Address', 'default', array('class'=>'error'));
			}
		}
		$this->set('title_for_layout', 'Canary Singles - Resend Username and Password');
	}

	/**
	 * Deactivates a users account by making them not visible.
	 * Does not stop paypal subscription yet. User does manually through Paypal account.
	 */
	public function deactivate_account() {
		if (!$this->is_admin()) {
			$this->redirect(array('action'=>'index'));
		}
		
		$current_user = $this->current_user();
		
		if ($current_user['User']['visible'] == 0) {
			$this->redirect(array('action'=>'reactivate_account'));
		}
		
		if (!empty($this->data) && $this->data['User']['deactivate'] == 'deactivate') {
			$this->User->id = $this->Auth->user('id');
			$this->User->saveField('visible', 0);
			$this->Session->setFlash('Your account has been deactivated. Remember, if you have a premium paid membership to also cancel it inside of your Paypal account as well in order to stop future billing.', 'default', array('class'=>'success'));
			$this->redirect(array('action'=>'account'));
		}
		$this->set('title_for_layout', 'Canary Singles - Deactivate Account');
	}
	
	/**
	 * Reactivates a users account by making them visible.
	 * Does not reinitialize Paypal subscription if they cancelled at Paypal. User will have to pay again.
	 */
	public function reactivate_account() {
		if (!$this->is_admin()) {
			$this->redirect(array('action'=>'index'));
		}
		
		$current_user = $this->current_user();
		
		if ($current_user['User']['visible'] == 1) {
			$this->redirect(array('action'=>'account'));
		}
		
		if (!empty($this->data) && $this->data['User']['reactivate'] == 'reactivate') {
			$this->User->id = $this->Auth->user('id');
			$this->User->saveField('visible', 1);
			$this->Session->setFlash('Your account has been reactivated.', 'default', array('class'=>'success'));
			$this->redirect(array('action'=>'account'));
		}
		$this->set('title_for_layout', 'Canary Singles - Reactivate Account');
	}	
	
	public function drawing() {
		if (!$this->is_admin()) {
			$this->redirect(array('action'=>'index'));
		}
		
		$male = $this->User->find('all', 
			array(
				'conditions'=>array('subscribed'=>'no', 'gender'=>'male', 'NOT'=>array('Avatar.avatar'=>null)), 
				'fields'=>array('username', 'email', 'gender', 'Avatar.avatar')));
		$female = $this->User->find('all', 
			array(
				'conditions'=>array('subscribed'=>'no', 'gender'=>'female', 'NOT'=>array('Avatar.avatar'=>null)), 
				'fields'=>array('username', 'email', 'gender', 'Avatar.avatar')));
		$this->set(compact('male', 'female'));
	}
	
	public function downgrade_member($id = null) {
		if (!$this->is_admin()) {
			$this->redirect(array('action'=>'index'));
		}
		
		$this->User->id = $id;
		$user = $this->User->read();
		$this->User->saveField('subscribed', 'no');
		$this->Session->setFlash($user['User']['username'].' was downgraded and is no longer a Premium member.');
		$this->redirect(array('action'=>'index'));
	}

	public function upgrade_member($id = null) {
		if (!$this->is_admin()) {
			$this->redirect(array('action'=>'index'));
		}
		
		$this->User->id = $id;
		$user = $this->User->read();
		$this->User->saveField('subscribed', 'yes');
		$this->Session->setFlash($user['User']['username'].' has been upgraded to be a Premium member.');
		$this->redirect(array('action'=>'index'));
	}
}
