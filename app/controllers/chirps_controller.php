<?php

class ChirpsController extends AppController {
	
	public $uses = array('Chirp', 'User');
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	/**
	 * Send a non premium/not subscribed user a chirp.
	 * 
	 * @param $friend_id the id of the user to send a chirp to.
	 * 
	 */
	public function chirp($friend_id = NULL) {
		// If logged in user is not subscribed deny access
		if ($this->isNotSubscribed()) {
			$this->Session->setFlash('You must upgrade your account to send chirps', 'default', array('class'=>'error'));
			$this->redirect(array('controller'=>'users', 'action'=>'upgrade'));
		}
		// if the user is trying to chirp a subscribed/paid user deny access
		// and tell user to send messsage instead
		if (!$this->friendIsNotSubscribed($friend_id)) {
			$this->Session->setFlash('You can\'t chirp premium memebers, send them a message instead.', 'default', array('class'=>'error'));
			$this->redirect(array('controller'=>'messages', 'action'=>'send', $friend_id));
		}
		if (!empty($this->data)) {
			if ($this->Chirp->save($this->data)) {
				$this->Session->setFlash('Your chirp has been sent!', 'default', array('class'=>'success'));
				$this->redirect(array('controller'=>'users', 'action'=>'index'));
			}
		}
		$this->set('user', $this->User->read(NULL, $friend_id));
	}
	
	/**
	 * Lets the logged in user view their chirps.
	 * 
	 */
	public function view() {
		$this->set('chirps', $this->Chirp->find('all', array('conditions'=>array('friend_id'=>$this->Auth->user('id')))));
	}
}
