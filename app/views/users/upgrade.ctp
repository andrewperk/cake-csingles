<?php if ($is_not_subscribed): ?>
	<h1>Upgrade Your Account!</h1>
	
	<p>Premium membership includes:</p>

	<ul>
		<li>sending chirps to non premium members</li>
		<li>email messaging to other premium members</li>
		<li>access to the relationship advice center</li>
	</ul>

	<p>Only $19.99 for three months.<br />
(Billed automatically to your credit card every three months. You must cancel to stop automatic billing.)</p>

<?php echo $paypal->button('Upgrade Now', array('type' => 'subscribe', 'custom'=>$current_user['User']['id'], 'return'=>'http://www.canarysingles.com/login', 'amount' => '19.99', 'term' => 'month', 'period' => '3')); ?>

<?php else: ?>
	<h1>You're Upgraded!</h1>
	<p>You've already been upgraded to a premium member. You can now interact with other canary single members.</p>
	<p>Get started by <?php echo $this->Html->link('searching for friends', array('action'=>'index')); ?>.</p>
<?php endif; ?>
