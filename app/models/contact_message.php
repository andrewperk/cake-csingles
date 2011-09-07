<?php

class ContactMessage extends AppModel {
	public $validate = array(
		'name'=>array(
			'notempty'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter your name.'
			)
		),
		'email'=>array(
			'notempty'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter your email.'
			),
			'valid'=>array(
				'rule'=>'email',
				'message'=>'Please enter a valid email address.'
			)
		),
		'subject'=>array(
			'notempty'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter a subject for your message.'
			)
		),
		'body'=>array(
			'notempty'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter your message.'
			)
		)
	);
}
