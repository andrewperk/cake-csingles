<?php
class MessagesController extends AppController {
  
	public $helpers = array('Text');
	public $components = array('Email');

	public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->deny('index');
	
		if ($this->action == "index" || $this->action == "view" || $this->action == "send" || $this->action == "reply") {
			if ($this->isNotSubscribed()) {
				$this->Session->setFlash("You must upgrade your account to contact members.", "default", array('class'=>'error'));
				$this->redirect(array('controller'=>'users', 'action'=>'upgrade'));
			}
		}
	}

	public function index() {
	$this->set('messages', $this->Message->find_messages($this->Auth->user('id')));
	}

	public function view($id = NULL) {
	$message = $this->Message->read(NULL, $id);
	// Logged in user can only view his/her own messages
	if ($message['Message']['friend_id'] != $this->Auth->user('id')) {
	  $this->redirect(array('controller'=>'messages', 'action'=>'index'));
	}
	$this->set('message', $message);
	}

	public function send($friend_id = NULL) {
	if (!empty($this->data)) {
	  // Check that they are friends before sending message
	  if ($this->Message->not_friends($this->Auth->user('id'), $this->data['Message']['friend_id'])) {
		$this->Session->setFlash('You are not friends with that user, request their friendship.', 'default', array('class'=>'error'));
		$this->redirect(array('controller'=>'users', 'action'=>'view', $this->data['Message']['friend_id']));
	  }
	  
	  // They are friends, send the message.
	  $this->data['Message']['user_id'] = $this->Auth->user('id');
	  if ($this->Message->save($this->data)) {
		$this->Session->setFlash('Message sent successfully', 'default', array('class'=>'success'));
		$this->redirect(array('controller'=>'messages', 'action'=>'index'));
	  } else {
		$this->Session->setFlash('Please correct the errors below:', 'default', array('class'=>'error'));
	  }
	}
		if ($this->Message->not_friends($this->Auth->user('id'), $friend_id)) {
		$this->Session->setFlash('You are not friends with that user, request their friendship.', 'default', array('class'=>'error'));
	  	$this->redirect(array('controller'=>'users', 'action'=>'view', $friend_id));
	  }
	$this->set('friend_id', $friend_id);
	$this->set('title_for_layout', 'Canary Singles - Send Message');
	}

	public function reply($message_id = NULL, $friend_id = NULL) {
	// Send Reply
	if (!empty($this->data)) {
	  // Check that the message belongs to the logged in user and
	  // that they are friends before sending message
	  if (!$this->Message->find('first', array('conditions'=>array('Message.friend_id'=>$this->Auth->user('id'), 'Message.id'=>$message_id))) && 
		  $this->Message->not_friends($this->Auth->user('id'), $this->data['Message']['friend_id']))
	  {
		$this->Session->setFlash('Invalid message or friend.', 'default', array('class'=>'error'));
		$this->redirect(array('controller'=>'users', 'action'=>'friends'));
	  }
	  
	  // They are friends, send the message.
	  $this->data['Message']['user_id'] = $this->Auth->user('id');
	  if ($this->Message->save($this->data)) {
		$this->Session->setFlash('Message sent successfully', 'default', array('class'=>'success'));
		$this->redirect(array('controller'=>'users', 'action'=>'friends'));
	  } else {
		$this->Session->setFlash('Please correct the errors below:', 'default', array('class'=>'error'));
	  }
	}
	$original_message = $this->Message->find('first', array('conditions'=>array('Message.friend_id'=>$this->Auth->user('id'), 'Message.id'=>$message_id)));
	$this->data['Message']['subject'] = "Re: " . $original_message['Message']['subject'];
	$this->set('friend_id', $friend_id);
	$this->set('original_message', $original_message);
	$this->set('title_for_layout', 'Canary Singles - Send Message');
	}
  
    /**
    * Sends a mass message to all users. 
    *
    * Only accessible by admins. Currently only sends message via email. Future todo is 
    * to also send a message to all users using the messaging system.
    * 
    * This is not part of the messages model. Extremely simple valiation done 
    * here via JS. Only admins access this, so assumed they have JS enabled.
    */
    function send_mass_message() {
    	// Admins can send a mass email to all users
    	if ($this->is_admin()) {
			$users = ClassRegistry::init('User')->find('all', array('recursive'=>-1, 'fields'=>array('username', 'email')));
			// $users = array(0=>array('User'=>array('username'=>'andrewperk', 'email'=>'andrewperk@gmail.com')), 1=>array('User'=>array('username'=>'cynthiaperkins', 'email'=>'cynthia.perkins@gmail.com')), 2=>array('User'=>array('username'=>'nouser', 'email'=>'joscmoe123898941@noonehsathismeail.org')), 3=>array('User'=>array('username'=>'andrewssupport', 'email'=>'support@andrewperkins.net')));
			$this->set('users', $users);
			$count = 0;
			if (!empty($this->data)) {
				foreach($users as $user) {
					$this->Email->to = $user['User']['email'];
					$this->Email->from = "Canary Singles <support@canarysingles.com>";
					$this->Email->subject = $this->data['Message']['subject'];
					$this->Email->template = "send_mass_message";
					$this->Email->sendAs = "html";
		
					$userData = array(
						'username'=>$user['User']['username'],
						'message'=>$this->data['Message']['message']
					);
		
					$this->set('user', $userData);
					$this->Email->send();	
					$count++;
				}
				if ($count == count($users)) {
					$this->Session->setFlash('<strong>Success</strong>: Mass message sent to '.$count.' users <br /><br /><strong>Subject:</strong><br />'.$this->data['Message']['subject'].'<br /><br /><strong>Message:</strong><br />'.$this->data['Message']['message'], 'default', array('class'=>'success'));
					$this->redirect(array('action'=>'send_mass_message'));
				}
			}
			$this->set('users', $users);
		// Not admin, no access, redirect out
		} else {
			$this->redirect(array('controller'=>'pages', 'action'=>'index'));
		}
    }

}
