<?php

class Chirp extends AppModel {
	public $belongsTo = array('User'); 
	
	public $validate = array(
		'Required user_id' => array(
			'user_id'=>array(
				'rule'=>'notEmpty',
				'message'=>'No user id.'
			)
		),
		'Required friend_id' => array(
			'friend_id'=>array(
				'rule'=>'notEmpty',
				'message'=>'No friend id.'
			)
		),
	);
}
