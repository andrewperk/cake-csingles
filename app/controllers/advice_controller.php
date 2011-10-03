<?php

class AdviceController extends AppController {
	public $uses = array('User');
	
	public function beforeFilter() {
		parent::beforeFilter();
		// Deny access to all advice pages for non premium users
		if ($this->isNotSubscribed()) {
			$this->Session->setFlash('You must upgrade to the premium membership to access the relationship advice center.', 'default', array('class'=>'error'));
			$this->redirect(array('controller'=>'users', 'action'=>'upgrade'));
		}
	}
	
	public function index() {
		$this->set('title_for_layout', 'Canary Singles - Advice');
	}
	
	public function canary_hunting() {
		$this->set('title_for_layout', 'Canary Singles - Canary Hunting');
	}
	
	public function negotiating_the_nest() {
		$this->set('title_for_layout', 'Canary Singles - Negotiating the Nest');
	}
	
	public function my_nest_or_yours() {
		$this->set('title_for_layout', 'Canary Singles - My Nest or Yours');
	}
	
	public function art_of_making_love() {
		$this->set('title_for_layout', 'Canary Singles - Art of Making Love');
	}
	
	public function number_1_great_sex_tip_communication() {
		$this->set('title_for_layout', 'Canary Singles - #1 Great Sex Tip - Communication');
	}
	
	public function expressing_love_affection() {
		$this->set('title_for_layout', 'Canary Singles - Expressing Love and Affection');
	}
	
	public function why_good_sex_important() {
		$this->set('title_for_layout', 'Canary Singles - Why Good Sex is Important');
	}
	
	public function prevent_infidelity() {
		$this->set('title_for_layout', 'Canary Singles - Prevent Infidelity');
	}
	
	public function make_love_to_man() {
		$this->set('title_for_layout', 'Canary Singles - How to Make Love to a Man');
	}
	
	public function make_love_to_woman() {
		$this->set('title_for_layout', 'Canary Singles - How to Make Love to a Woman');
	}
	
	public function four_differences_between_men_and_women() {
		$this->set('title_for_layout', 'Canary Singles - Four Differences Between Men and Women');
	}
	
	public function sexual_needs() {
		$this->set('title_for_layout', 'Canary Singles - Sexual Needs');
	}
	
	public function keeping_passion_alive() {
		$this->set('title_for_layout', 'Canary Singles - Keeping Passion Alive');
	}
	
	public function keys_to_passionate_relationship() {
		$this->set('title_for_layout', 'Canary Singles - Keys to Passionate Relationship');
	}
	
	public function sexuality_and_chronic_illness() {
		$this->set('title_for_layout', 'Canary Singles - Sexuality and Chronic Illness');
	}
}
