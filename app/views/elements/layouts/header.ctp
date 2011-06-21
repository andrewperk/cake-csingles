<div id="header">
  <div id="header-content">
    <?php echo $this->Html->image('canaries.png', array('alt'=>'Canary Singles', 'url'=>array('controller'=>'pages', 'action'=>'index'))); ?>
    <h1>Canary Singles</h1>
    <h3>&nbsp;</h3>
  </div>
  
  
  <div id="login">
  <?php if ($logged_in): ?>
    <p class="logged_in_as">
      You are logged in as: &nbsp;<br /> <?php echo ucfirst($current_user['User']['username']); ?>.
    </p>
  <?php else: ?>
    <p class="login">
    	<?php echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login')); ?>
    </p>
  <?php endif; ?>
  </div>
  
</div><!-- end header -->