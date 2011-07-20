<?php

class UsersController extends AppController {
  public $helpers = array('Friend', 'Text');
  public $paginate = array(
    'limit'=>'10'
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
    $this->Auth->allow('add', 'view');
    
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
  	// Searching users
  	if (!empty($this->data)) {
  		// By name, gender, and state
  		if (!empty($this->data['User']['search_name']) && !empty($this->data['User']['search_gender']) && !empty($this->data['User']['search_state'])) {
  			$this->paginate = array('conditions' => array('OR'=>array(
					'User.username LIKE' => '%'.$this->data['User']['search_name'].'%',
					'User.firstname LIKE' => '%'.$this->data['User']['search_name'].'%',
					'User.lastname LIKE' => '%'.$this->data['User']['search_name'].'%'),
					'AND'=>array(
					'User.gender'=>$this->data['User']['search_gender'],
					'User.state'=>$this->data['User']['search_state'])
				));
  		}
			// by name and gender
			else if (!empty($this->data['User']['search_name']) && !empty($this->data['User']['search_gender'])) {
  			$this->paginate = array('conditions' => array('OR'=>array(
					'User.username LIKE' => '%'.$this->data['User']['search_name'].'%',
					'User.firstname LIKE' => '%'.$this->data['User']['search_name'].'%',
					'User.lastname LIKE' => '%'.$this->data['User']['search_name'].'%'),
					'AND'=>array(
					'User.gender'=>$this->data['User']['search_gender'])
				));
  		}
			// by name and state
			else if (!empty($this->data['User']['search_name']) && !empty($this->data['User']['search_state'])) {
  			$this->paginate = array('conditions' => array('OR'=>array(
					'User.username LIKE' => '%'.$this->data['User']['search_name'].'%',
					'User.firstname LIKE' => '%'.$this->data['User']['search_name'].'%',
					'User.firstname LIKE' => '%'.$this->data['User']['search_name'].'%'),
					'AND'=>array(
					'User.state'=>$this->data['User']['search_state'])
				));
  		}
			// by gender and state
			else if (!empty($this->data['User']['search_gender']) && !empty($this->data['User']['search_state'])) {
  			$this->paginate = array('conditions' => array(
					'User.gender' => $this->data['User']['search_gender'],
					'User.state'=>$this->data['User']['search_state']
				));
  		}
			// by name
			else if (!empty($this->data['User']['search_name'])) {
  			$this->paginate = array('conditions' => array('OR'=>array(
					'User.username LIKE' => '%'.$this->data['User']['search_name'].'%',
					'User.firstname LIKE' => '%'.$this->data['User']['search_name'],
					'User.lastname LIKE' => '%'.$this->data['User']['search_name'])
				));
  		}
			// by gender
			else if (!empty($this->data['User']['search_gender'])) {
  			$this->paginate = array('conditions' => array(
					'User.gender' => $this->data['User']['search_gender']
				));
  		}
			// by state
			else if (!empty($this->data['User']['search_state'])) {
  			$this->paginate = array('conditions' => array(
					'User.state' => $this->data['User']['search_state']
				));
  		}
			$results = $this->paginate('User');
			$this->set('users', $results);
		}
		// Default retrieval of all users
		else {
    	$this->set('users', $this->paginate('User'));
    	$this->set('title_for_layout', 'Canary Singles');
  	}
	}
  
  /**
   * Register a user. 
   */
  public function add() {
    if (!empty($this->data)) {
      if ($this->User->save($this->data)) {        
        $this->Session->setFlash('Thanks for registering. You can now login and update your profile and avatar.', 'default', array('class'=>'success'));
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
				$this->redirect(array('controller'=>'messages', 'action'=>'chirp', $friend_id));
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
		$this->set('title_for_layout', 'Canary Singles');
	}
}