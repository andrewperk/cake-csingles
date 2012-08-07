<?php 
class FriendHelper extends AppHelper {
  public $helpers = array('Session');
  public $Auth; 
  public $user;
  public $User;

  public function beforeRender() {
    App::import('Component', 'Auth');
    $this->Auth = new AuthComponent();
    $this->Auth->Session = $this->Session;
    $this->user = $this->Auth->user();

    App::import('Model', 'User');
    $this->User = new User();
  }

  /**
   * Determines if they are already friends or self.
   *
   * @param id the id of the friend to check
   */
  public function not_friend_or_self($id) {
    if ($this->Auth->user('id') != $id) {
      $friend = $this->User->UsersUser->find('first', array('conditions'=>array('user_id'=>$this->Auth->user('id'), 'friend_id'=>$id)));
      if (empty($friend)) {
        return true;
      }
    }
    return false;
  }
	
	/**
   * Determines if the user is subscribed.
   *
   * @param id the id of the user to check
   */
  public function user_not_subscribed($id) {
		$user = $this->User->read(NULL, $id);
		if ($user['User']['subscribed'] != "yes") {
			return TRUE;
		}
    return FALSE;
  }
}