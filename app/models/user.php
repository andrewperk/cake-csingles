<?php

class User extends AppModel {
	public $actsAs = array('Search.Searchable');
  public $hasOne = array('Avatar');
  public $hasMany = array('Message', 'Chirp');
  public $hasAndBelongsToMany = array(
    'Friend'=>array(
      'className'=>'User',
      'join_table'=>'users_users',
      'foreign_key'=>'user_id',
      'associationForeignKey'=>'friend_id'
    )
  );
  
  public $filterArgs = array(
  	array('name'=>'search_gender', 'type'=>'value', 'field'=>'User.gender'),
  	array('name'=>'search_state', 'type'=>'value', 'field'=>'User.state'),
  	array('name'=>'search_name', 'type'=>'like', 'field'=>'User.username'),
  	//array('name'=>'search_email', 'type'=>'like', 'field'=>'User.email'),
  	array('name'=>'search_country', 'type'=>'like', 'field'=>'User.country')
  );
  
  public $validate = array(
    'username'=>array(
      'Not Empty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Please enter your desired username.'
      ),
      'Username 4 length'=>array(
        'rule'=>array('minLength', 4),
        'message'=>array('Username must be at least 4 characters in length')
      ),
      'Username can only be alphanumeric'=>array(
        'rule'=>'alphaNumeric',
        'message'=>'Username can only be letters and numbers.'
      ),
      'Must be unique'=>array(
        'rule'=>'isUnique',
        'message'=>'That username is taken, try another.'
      )
    ),
    'email'=>array(
      'Not empty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Please enter your email address.'
      ),
      'Valid email'=>array(
        'rule'=>'email',
        'message'=>'This is not a valid email address.'
      ),
      'Must be unique'=>array(
        'rule'=>'isUnique',
        'message'=>'That email address is already taken.'
      )
    ),
    'password'=>array(
      'Minimum 6 length'=>array(
        'rule'=>array('minLength', 6),
        'message'=>'Password must be at least 6 characters in length.'
      ),
      'Passwords must match'=>array(
        'rule'=>'matchPasswords',
        'message'=>'The passwords do not match.'
      )
    ),
    'ToS'=>array(
    	'rule'=>'/1/',
    	'message'=>'You must agree to the terms of service.'
    )
  );

  public function matchPasswords($data) {
    if ($data['password'] == $this->data['User']['password_confirmation']) {
      return TRUE;
    }
    $this->invalidate('password_confirmation', 'The passwords do not match.');
    return FALSE;
  }

  public function hashPasswords($data) {
    if (isset($this->data['User']['password'])) {
      $this->data['User']['password'] = Security::hash($this->data['User']['password'], NULL, TRUE);
      return $data;
    }
    return $data;
  }

  public function beforeSave() {
    $this->hashPasswords(NULL, TRUE);
    return TRUE;
  }
  
  /**
   * Find all of a users friends.
   * 
   * @param user_id the id of the user to find their friends.
   * @return array the users friends.
  */
  public function get_friends($user_id)
  {
    $friends = array();
    $friends_list = $this->UsersUser->find('all', array('conditions'=>array('accepted'=>1, 'user_id'=>$user_id)));
    $friends_ids = array();
    for ($i = 0; $i < sizeof($friends_list); $i++) {
      $friends_ids[$i] = $friends_list[$i]['UsersUser']['friend_id'];
    }

    for ($j = 0; $j < sizeof($friends_ids); $j++) {
      $this->recursive = 0;
      $friends[$j] = $this->findAllById($friends_ids[$j], array('User.id', 'User.username', 'User.visible', 'Avatar.avatar'));
    }
    return $friends;
  }
  
  /**
   * Creates a friend request.
   * Creates both the initial friend request setting the original column to 1, 
   * which is true meaning this was the original request. Also creates the 
   * opposite friendship. Both are considered not accepted 0 by default.
   * 
   * @param user_id the id of the user requesting a friendship.
   * @param friend_id the id of the friend who should approve the request.
   * @return boolean true if successfully added, false otherwise.
   */
  public function create_friend_request($user_id, $friend_id)
  {
    if ($this->UsersUser->save(array('UsersUser'=>array('user_id'=>$user_id, 'friend_id'=>$friend_id, 'original'=>1))) && 
        $this->UsersUser->create() && 
        $this->UsersUser->save(array('UsersUser'=>array('user_id'=>$friend_id, 'friend_id'=>$user_id))))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
  
  /**
   * Accepts a friend request.
   * Finds the original friend request and the 
   * opposite friend request.
   * Attemps to set both accepted fields to 1 (true) as accepted.
   * 
   * @param user_id the user id who is accepting the friendship
   * @param friend_id the id of the user who requested friendship
   * @return boolean true or false if friendship was made
   */
  public function accept_friend_request($user_id, $friend_id)
  {
    // Find original friend request
    $request = $this->UsersUser->find('first', array('conditions'=>array('friend_id'=>$user_id, 'user_id'=>$friend_id, 'accepted'=>0, 'original'=>1)));
    // Find opposite friend request
    $opposite_request = $this->UsersUser->find('first', array('conditions'=>array('user_id'=>$user_id, 'friend_id'=>$friend_id, 'accepted'=>0, 'original'=>0)));
    // make opposite request accepted first
    if ($opposite_request) {
      $this->UsersUser->id = $opposite_request['UsersUser']['id'];
      $this->UsersUser->save(array('UsersUser'=>array('accepted'=>1)));
      
      // make original request accepted
      if ($request) {
        $this->UsersUser->id = $request['UsersUser']['id'];
        if ($this->UsersUser->save(array('UsersUser'=>array('accepted'=>1)))) {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
      }
    }
    else
    {
      return FALSE;
    }
  }
  
  /**
   * Find the user's friend requests.
   * 
   * @param user_id the logged in users id to find their friend requests.
   * @return array of the logged in users friend requests.
   */
  public function get_friend_requests($user_id)
  {
    // Find all requests for this user who have not been accepted
    // are not the original requester IE. original should be 0
    // user_id should be equal to the user id since this user 
    // is not the one who made the request
    $friend_requests = $this->UsersUser->find('all', array('conditions'=>array('accepted'=>0, 'original'=>0, 'user_id'=>$user_id)));
    $requests_ids = array();
    // Loop through those requests and get the id of the requested friend
    for ($i = 0; $i < sizeof($friend_requests); $i++) {
      $requests_ids[$i] = $friend_requests[$i]['UsersUser']['friend_id'];
    }
    $requests = array();
    // Loop through the requested friend id's and find the actual friend
    for ($j = 0; $j < sizeof($requests_ids); $j++) {
      $this->recursive = 0;
      $requests[$j] = $this->read(NULL, $requests_ids[$j]);
    }
    return $requests;
  }
  
  /**
   * Delete a friend.
	 * Remove both friendships.
   * 
   * @param user_id the user who is deleting a friend
   * @param friend_id the friend to delete
   * @return boolean true or false if delete was successful
   */
  public function delete_friend($user_id, $friend_id) {
  	$friendship = $this->UsersUser->find('first', array('conditions'=>array('user_id'=>$user_id, 'friend_id'=>$friend_id, 'accepted'=>1)));
		$opposite_friendship = $this->UsersUser->find('first', array('conditions'=>array('user_id'=>$friend_id, 'friend_id'=>$user_id, 'accepted'=>1)));
		if (!empty($friendship) && !empty($opposite_friendship)) {
			if ($this->UsersUser->delete($friendship['UsersUser']['id']) && 
					$this->UsersUser->delete($opposite_friendship['UsersUser']['id'])) {
				return TRUE;
			}
		}
		else {
			return FALSE;
		}
  }
	
	/**
	 * Validate email address for password reset.
	 * 
	 * @param email the address to validate
	 * @return boolean true if email validates
	 */
	public function validate_email($email) {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * Check the valid email address matches a registered user.
	 * Return true if a user is found with the passed in email address.
	 * 
	 * @param email the email to check
	 * @return boolean true if a user matched the email
	 */
	public function find_email_match($email) {
		$user = $this->findByEmail(strtolower($email));
		if (!empty($user)) {
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * Generate random password 8 characters long for password reset.
	 * 
	 * @return string random characters.
	 */
	public function generate_random_password() {
		$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($characters), 0, 8);
	}
}
