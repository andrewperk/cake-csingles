<?php
class Message extends AppModel {
  public $belongsTo = array('User');
  public $validate = array(
    'subject'=>array(
      'Not empty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Give your message a subject.'
      )
    ),
    'body'=>array(
      'Not empty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Enter your message.'
      )
    )
  );
  
  /**
   * Determines if the logged in user is a friend of the
   * passed in friend_id.
   *
   * @param $user_id the logged in user who's sending the message
   * @param $friend_id the friend who will receive the message
   * @return boolean true if not friends
   */
  public function not_friends($user_id, $friend_id) {
    $friendship = $this->User->UsersUser->find('first', array('conditions'=>array('user_id'=>$user_id, 'friend_id'=>$friend_id, 'accepted'=>1)));
		$opposite_friendship = $this->User->UsersUser->find('first', array('conditions'=>array('user_id'=>$friend_id, 'friend_id'=>$user_id, 'accepted'=>1)));
		if (!empty($friendship) && !empty($opposite_friendship)) {
			return FALSE;
		}
		else {
			return TRUE;
		}
  }
  
  /**
   * Find the logged in user's messages.
   *
   * @param $user_id the logged in user's id
   * @return array the users messages
   */
  public function find_messages($user_id) {
    $messages = NULL;
    // Their user_id will be in the friend_id slot if
    // they have a message
    $this->recursive = 2;
    $messages = $this->findAllByFriendId($user_id, array(), array('Message.id'=>'desc'));
    return $messages;
  }
}