<?php 

class AvatarsController extends AppController {
  public $components = array('Image');
  
  public function beforeFilter() {
    parent::beforeFilter();
    
    // Ensure user is logged in before accessing add and edit
    if ($this->action == 'add' || $this->action == 'edit') {
      if (!$this->logged_in()) {
        $this->redirect(array('controller'=>'pages', 'action'=>'index'));
      }
    }
  }

  public function add() {
    // If user has an avatar already send to edit page
    if ($this->has_avatar()) {
      $this->redirect(array('action'=>'edit'));
    }
    
    // Otherwise add a new avatar
    if (!empty($this->data)) {
      if ($image_path = $this->Image->upload_image_and_thumbnail($this->data, "avatar", 573, 100, "avatars", TRUE)) {
        if ($this->Avatar->save(array('Avatar'=>array('user_id'=>$this->Auth->user('id'), 'avatar'=>$image_path)))) {
          $this->Session->setFlash('Your picture was saved.', 'default', array('class'=>'success'));
          $this->redirect(array('controller'=>'users', 'action'=>'view', $this->Auth->user('id')));
        }
        else {
          $this->Session->setFlash('Please correct the errors:', 'default', array('class'=>'error'));  
        }
      }
    }
  }

  public function edit() {
    // If user does not have an avatar send to add page
    if (!$this->has_avatar()) {
      $this->redirect(array('action'=>'add'));
    }
    
    // Find the logged in users avatar
    $avatar = $this->Avatar->findByUserId($this->Auth->user('id'));
    $avatar_id = $avatar['Avatar']['id'];
    
    // Set the id of the avatar to edit
    $this->Avatar->id = $avatar_id;
    
    if (!empty($this->data)) {
      // Get the old avatar first to delete after successful update
      $avatar_to_delete = $avatar['Avatar']['avatar'];
      // Save the new avatar
      if ($image_path = $this->Image->upload_image_and_thumbnail($this->data, 'avatar', 574, 100, "avatars", TRUE)) {
        if ($this->Avatar->save(array('Avatar'=>array('user_id'=>$this->Auth->user('id'), 'avatar'=>$image_path)))) {
          $this->Image->delete_image($avatar_to_delete, 'avatars');
          $this->Session->setFlash('Your picture was saved.', 'default', array('class'=>'success'));
          $this->redirect(array('controller'=>'users', 'action'=>'view', $this->Auth->user('id')));
        }
        else {
          $this->Session->setFlash('Please correct the errors:', 'default', array('class'=>'error'));  
        }
      }
    }
    
    if (empty($this->data)) {
      $this->data = $this->Avatar->read();
    }
    $this->set('avatar', $avatar);
  }
  
  /**
   * Checks if the logged in user has an avatar.
   *
   * @return boolean true if user has an avatar.
   */
  private function has_avatar() {
    if ($this->Avatar->findByUserId($this->Auth->user('id'))) {
      return TRUE;
    }
    return FALSE;
  }
}