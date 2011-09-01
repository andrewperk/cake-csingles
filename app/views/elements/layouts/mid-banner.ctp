<div id="mid-banner">
  <?php echo $this->Html->image('mid-banner-couple.jpg'); ?>
	<div id="signup-process">
		<ol>
			<li><p><span>1</span> Register<small>(Free)</small></p></li>
			<li><p><span>2</span> Add Profile<small>(Free)</small></p></li>
			<li><p><span>3</span> Search<small>(Free)</small></p></li>
			<li><p><span>4</span> Contact</p></li>
		</ol>
	</div>
		<?php echo $this->Form->create('User', array('controller'=>'users', 'action'=>'add'));?>
		<p><?php echo $this->Form->label('User.username', 'Username: '); ?>
		<?php echo $this->Form->text('User.username'); ?></p>
		<p><?php echo $this->Form->label('User.email', 'Email: '); ?>
		<?php echo $this->Form->text('User.email'); ?></p>
		<p><?php echo $this->Form->label('User.password', 'Password: '); ?>
		<?php echo $this->Form->password('User.password'); ?></p>
		<p><?php echo $this->Form->label('User.password_confirmation', 'Confirm Password: '); ?>
		<?php echo $this->Form->password('User.password_confirmation'); ?></p>
		<p id="tos">
  	<?php echo $this->Form->checkbox('ToS', array('type'=>'checkbox', 'div'=>false)); ?> 
  	<?php echo $this->Form->label('ToS', 'I agree to the ', array('class'=>'tos')); ?> 
    <?php echo $this->Html->link('Terms of Service', array('controller'=>'pages', 'action'=>'tos')); ?> 
  	</p> 
		<p class="register_button"><label for="register_button">&nbsp;</label>
		<?php echo $this->Form->submit('Register', array('id'=>'register_button', 'class'=>'button', 'div'=>FALSE)); ?></p>
		<?php echo $this->Form->end(); ?>
</div><!-- mid-banner -->