<div id="header">
  <div id="header-content">
    <?php echo $this->Html->image('canaries.jpg', array('alt'=>'Canary Singles', 'url'=>array('controller'=>'pages', 'action'=>'index'))); ?>
    <h1>Canary Singles</h1>
    <h3>&nbsp;</h3>
  </div>
  
  
  
  <?php if ($logged_in): ?>
  <div id="login">
    <p class="logged_in_as">
      You are logged in as: &nbsp;<br /> <?php echo ucfirst($current_user['User']['username']); ?>.
    </p>
  </div>
  <?php else: ?>
  	<?php if ($not_login_register): ?>
  	<div id="login">
    	<?php echo $this->Form->create('User', array('controller'=>'users', 'action'=>'login')); ?>
			<p>
				<?php echo $this->Form->label('User.username', '&nbsp;'); ?>
				<?php echo $this->Form->text('User.username', array('id'=>'login_username', 'value'=>'Username')); ?>
			</p>
			<p>
				<?php echo $this->Form->label('User.password', '&nbsp;'); ?>
				<?php echo $this->Form->password('User.password', array('id'=>'login_password', 'value'=>'Password')); ?>
			</p>
			<p id="forgot-password-link">
				<?php echo $this->Html->link('Forgot?', array('controller'=>'users', 'action'=>'resend_password')); ?>
			</p>
			<p class="login_button">
				<label for="login_button">&nbsp;</label>
				<?php echo $this->Form->submit('Login', array('id'=>'login_button', 'class'=>'button', 'div'=>FALSE)); ?>
			</p>
			<?php echo $this->Form->end(); ?>
		</div>
		<?php endif; ?>
  <?php endif; ?>
  
</div><!-- end header -->
