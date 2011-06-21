<?php

class AppController extends Controller {
  public $helpers = array('Form', 'Html', 'Session');
  public $components = array('Session', 'Auth', 'Security');

  /**
   * Intializes Auth component variables.
   * 
   * Checks for different states of users: logged in, admin etc..
   */
  public function beforeFilter() {
    $this->Auth->allow('index');
    $this->Auth->logoutRedirect = array('controller'=>'pages', 'action'=>'index');
    $this->Auth->loginError = "Incorrect username/password combination.";
    $this->Auth->authError = "Please login.";
    $this->Auth->autoRedirect = FALSE;

    // Check for logged in User
    $this->set('logged_in', $this->logged_in());
    // Send current user to view
    $this->set('current_user', $this->current_user());
    // Check for an admin
    $this->set('is_admin', $this->is_admin());
  }

  /**
   * Checks if a user is logged in.
   * 
   * @return boolean
   */
  protected function logged_in() {
    if ($this->Auth->user()) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Returns the current user.
   * 
   * @return the current user
   */
  protected function current_user() {
    if ($this->logged_in()) {
      return $this->User->read(NULL, $this->Auth->user('id'));
    }
  }
  
  /**
   * Checks if an admin is logged in.
   * 
   * @return boolean
   */
  protected function is_admin() {
    if ($this->Auth->user('role') == 'admin') {
      return TRUE;
    }
    return FALSE;
  }
  
  /**
   * Checks if they are friends or self 
   * to determine if a friend link should be displayed.
   */
  protected function not_friends_or_self() {
    
  }
}