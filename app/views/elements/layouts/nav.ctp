<div id="main-nav">
  <ul id="nav">
    <li><?php echo $this->Html->link('Home', array('controller'=>'pages', 'action'=>'index'))?></li>
    <li>
      <?php echo $this->Html->link('FAQ\'s', array('controller'=>'pages', 'action'=>'faqs')); ?>
    </li>
    <li><?php echo $this->Html->link('Search', array('controller'=>'users', 'action'=>'index'))?></li>
    <li><?php echo $this->Html->link('Contact', array('controller'=>'contact_messages', 'action'=>'send'))?></li>
    <?php if ($logged_in): ?>
	    <?php 
	    // If they are a premium member
	    if (!$is_not_subscribed): ?>
	    <li>
	      <?php echo $this->Html->link('Friends', array('controller'=>'users', 'action'=>'friends'))?>
	      <ul class="subnav">
	        <li><?php echo $this->Html->link('All Friends', array('controller'=>'users', 'action'=>'friends'))?></li>
	        <li><?php echo $this->Html->link('Friend Requests', array('controller'=>'users', 'action'=>'friend_requests'))?></li>
	      </ul>
	    </li>
	    <?php endif; ?>
		  <li>
		    <?php echo $this->Html->link('Account', array('controller'=>'users', 'action'=>'account'))?>
		    <ul class="subnav">
		      <li><?php echo $this->Html->link('Edit Account', array('controller'=>'users', 'action'=>'account'))?></li>
		      <li><?php echo $this->Html->link('View Profile', array('controller'=>'users', 'action'=>'view', $current_user['User']['id']))?></li>
		      <li><?php echo $this->Html->link('Avatar', array('controller'=>'avatars', 'action'=>'add'))?></li>
		      <?php 
		      // If they are not a premium member
		      if($is_not_subscribed): ?>
		      	<li><?php echo $this->Html->link('Upgrade Account', array('controller'=>'users', 'action'=>'upgrade'))?></li>
		      <?php endif; ?>
		    </ul>
		  </li>
		  <?php 
		  // If they are a premium member
		  if (!$is_not_subscribed): ?>
		  <li>
		    <?php echo $this->Html->link('Messages', array('controller'=>'messages', 'action'=>'index')); ?>
		  </li>
		  <?php endif; ?>
		  <li>
		    <?php echo $this->Html->link('Chirps', array('controller'=>'chirps', 'action'=>'view')); ?>
		  </li>
		  <?php if (!$is_not_subscribed): ?>
		  	<li><?php echo $this->Html->link('Advice', array('controller'=>'advice', 'action'=>'index')); ?></li>
		  <?php endif; ?>
    	<li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'))?></li>        
    <?php endif; ?>
  </ul>
</div><!-- end main-nav -->
