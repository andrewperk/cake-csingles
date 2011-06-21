<fieldset>
  <legend>Register</legend>
  <?php echo $this->Form->create('User', array('action'=>'add')); ?>
  <p><?php echo $this->Form->input('firstname', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('lastname', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('username', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('email', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('password', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('password_confirmation', array('label'=>'Confirm', 'div'=>false, 'type'=>'password')); ?></p>
  <p><?php echo $this->Form->submit('Register', array('class'=>'button', 'div'=>false)); ?></p>
<?php echo $this->Form->end(); ?>
</fieldset>