<?php

class Avatar extends AppModel {
  public $belongsTo = array('User');
  public $validate = array(
    'avatar'=>array(
      'Not Empty'=>array(
        'rule'=>array('extension', array('jpg', 'jpeg', 'gif', 'png')),
        'message'=>'That is not a valid image.',
      )
    )
  );
}