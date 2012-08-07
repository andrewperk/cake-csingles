<?php
class ipnSchema extends CakeSchema {
  var $name = 'ipn';
  
  function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}  
  
  var $instant_payment_notifications = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'notify_version' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'verify_sign' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'test_ipn' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'address_city' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40),
		'address_country' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'address_country_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 2),
		'address_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'address_state' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40),
		'address_status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'address_street' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200),
		'address_zip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'last_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'payer_business_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'payer_email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'payer_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 13),
		'payer_status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'contact_phone' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'residence_country' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 2),
		'business' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'item_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'item_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'quantity' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'receiver_email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'receiver_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 13),
		'custom' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'invoice' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'memo' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'option_name1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'option_name2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'option_selection1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200),
		'option_selection2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200),
		'tax' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'auth_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 19),
		'auth_exp' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'auth_amount' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'auth_status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'num_cart_items' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'parent_txn_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 19),
		'payment_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'payment_status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'payment_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'pending_reason' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'reason_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'remaining_settle' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'shipping_method' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'shipping' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'transaction_entity' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'txn_id' => array('type' => 'string', 'null' => true, 'length' => 19),
		'txn_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'exchange_rate' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3),
		'mc_fee' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_gross' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_handling' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_shipping' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'payment_fee' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'payment_gross' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'settle_amount' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'settle_currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3),
		'auction_buyer_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'auction_closing_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'auction_multi_item' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'for_auction' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'subscr_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'subscr_effective' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'period1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'period2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'period3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'amount1' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'amount2' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'amount3' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_amount1' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_amount2' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_amount3' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'recurring' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1),
		'reattempt' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1),
		'retry_at' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'recur_times' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'username' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'password' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 24),
		'subscr_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 19),
		'case_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'case_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'case_creation_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	
	var $paypal_items = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'instant_payment_notification_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36),
		'item_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'item_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'quantity' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127),
		'mc_gross' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_shipping' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'mc_handling' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'tax' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);

}
?>