<div id="forgot-password">
	<p>I have brain fog and 
		<?php echo $this->Html->link('forgot my username/password', array('controller'=>'users', 'action'=>'resend_password')); ?></p>
</div>
<div id="login-fieldset">
	<h1>Login</h1>
  <?php echo $this->Form->create('User', array('action'=>'login')); ?>
  <p><?php echo $this->Form->input('username', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('password', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->submit('Login', array('class'=>'button', 'div'=>false)); ?></p>
<?php echo $this->Form->end(); ?>
</div>
<p>Don't have an account? <?php echo $this->Html->link("Register now for free", array('action'=>'add')); ?>!</p>