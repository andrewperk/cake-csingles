<?php
class MessagesController extends AppController {
  
  public $helpers = array('Text');
  
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

}