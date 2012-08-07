<?php

App::import('Vendor', 'HTMLPurifier', array('file'=>'htmlpurifier'.DS.'library'.DS.'HTMLPurifier.auto.php'));

class HpurifierHelper extends AppHelper {

	// The HTMLPurifier
	public $Hpurifier;
	
	/**
	 * Construct the HTMLPurifier
	 *
	 * Set the TidyLevel to heavy
	 *   - Can also be light, medium, and of course heavy
	 */
	public function __construct() {
		$config = HTMLPurifier_Config::createDefault();
		$config->set('HTML.TidyLevel', 'heavy'); // light, medium, heavy
		$this->Hpurifier = new HTMLPurifier($config);
	}

	/**
	 * Purify data from view to allow some html
	 * @return purified data
	 */
	public function purify($data) {
		return $this->Hpurifier->purify($data);
	}
}