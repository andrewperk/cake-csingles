<?php if ($is_not_subscribed): ?>
	<h1>Upgrade Your Account!</h1>
	<p>Upgrade to our premium membership to add friends and communicate with them.</p>
	<p>Only $19.95 billed every 3 months</p>
<?php echo $paypal->button('Upgrade', array('test' => TRUE, 'type' => 'subscribe', 'custom'=>$current_user['User']['id'], 'amount' => '19.95', 'term' => 'month', 'period' => '3')); ?>
<?php else: ?>
	<h1>You're Upgraded!</h1>
	<p>You've already been upgraded to a premium member. You can now interact with other canary single members.</p>
	<p>Get started by <?php echo $this->Html->link('searching for friends', array('action'=>'index')); ?>.</p>
<?php endif; ?>