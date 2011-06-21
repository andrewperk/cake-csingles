<fieldset>
  <legend>Login</legend>
  <?php echo $this->Form->create('User', array('action'=>'login')); ?>
  <p><?php echo $this->Form->input('username', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->input('password', array('div'=>false)); ?></p>
  <p><?php echo $this->Form->submit('Login', array('class'=>'button', 'div'=>false)); ?></p>
<?php echo $this->Form->end(); ?>
</fieldset>