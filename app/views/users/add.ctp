<div id="register">
	<h1>Register Now - It's Free</h1>
  <?php echo $this->Form->create('User', array('action'=>'add')); ?>
  <p><?php echo $this->Form->input('username', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('email', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('password', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('password_confirmation', array('label'=>'Confirm', 'div'=>false, 'type'=>'password')); ?></p>
  <p id="tos">
	  	<?php echo $this->Form->label('ToS', 'I agree to the ', array()); ?> 
	  	<?php echo $this->Form->checkbox('ToS', array('type'=>'checkbox', 'div'=>false)); ?> 
	  	<?php echo $this->Html->link('Terms of Service', array('controller'=>'pages', 'action'=>'tos')); ?> 
	  	<?php echo $this->Form->error('ToS', array('class'=>'tos-error-message')); ?>
  </p> 
  <p><?php echo $this->Form->submit('Register', array('class'=>'button', 'div'=>false)); ?></p>
<?php echo $this->Form->end(); ?>
</div>
<p>Already a member? <?php echo $this->Html->link('Log in now', array('action'=>'login')); ?>.</p>