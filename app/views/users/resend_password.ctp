<div id="resend-password-fieldset">
	<h1>Username and Password Retreival</h1>
	<p>We can send you your current username and password reset instructions to the email address associated with your account.</p>
	<?php echo $this->Form->create('User', array('action'=>'resend_password')); ?>
	<p><?php echo $this->Form->input('email', array('label'=>'Your Account Email Address', 'div'=>FALSE)); ?></p>
	<p><?php echo $this->Form->submit('Send', array('div'=>FALSE, 'class'=>'button')); ?></p>
	<?php echo $this->Form->end(); ?>
</div>
