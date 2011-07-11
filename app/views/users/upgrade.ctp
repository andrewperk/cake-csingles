<?php if ($is_not_subscribed): ?>
	<h1>Upgrade Your Account!</h1>
	<p>Upgrade to add friends and communicate with them. Only $15 billed monthly</p>
<?php echo $paypal->button('Upgrade', array('test' => true, 'type' => 'subscribe', 'custom'=>$current_user['User']['id'], 'amount' => '15.00', 'term' => 'month', 'period' => '1')); ?>
<?php else: ?>
	<h1>You're Upgraded!</h1>
	<p>You've already been upgraded as a paying customer. You can now interact with other canary single members.</p>
	<p>Get started by <?php echo $this->Html->link('searching for friends', array('action'=>'index')); ?>.</p>
<?php endif; ?>