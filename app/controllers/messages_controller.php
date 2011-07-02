<?php
class MessagesController extends AppController {
  
  public $helpers = array('Text');
  
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->deny('index');
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
        $this->Session->setFlash('You are not friends with that user.', 'default', array('class'=>'error'));
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
    $this->set('friend_id', $friend_id);
    $this->set('title_for_layout', 'Canary Singles - Send Message');
  }
}