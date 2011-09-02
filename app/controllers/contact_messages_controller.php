<?php 

class ContactMessagesController extends AppController {
	
	public $components = array('Email');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('send');
	}
	
	public function send() {
		if (!empty($this->data)) {
			if ($this->ContactMessage->save($this->data)) {
				
				// Send Email
				$this->Email->to = 'support@canarysingles.com';
				$this->Email->from = $this->data['ContactMessage']['email'];
				$this->Email->subject = "Canary Singles Support: " . $this->data['ContactMessage']['subject'];
				$this->Email->template = "contact_message";
				$this->Email->sendAs = "text";
				
				$message = array(
					'name'=>$this->data['ContactMessage']['name'],
					'email'=>$this->data['ContactMessage']['email'],
					'subject'=>$this->data['ContactMessage']['subject'],
					'body'=>$this->data['ContactMessage']['body']
				);
				
				$this->set('message', $message);
				$this->Email->send();
				
				$this->Session->setFlash('Thank you. Your message was received.', 'default', array('class'=>'success'));
				$this->redirect(array('action'=>'send'));
			}
			else {
				$this->Session->setFlash('Please fix the errors below:', 'default', array('class'=>'error'));
			}
		}
		$this->set('title_for_layout', 'Canary Singles - Contact');
	}
}
