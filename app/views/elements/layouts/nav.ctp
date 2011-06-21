<div id="main-nav">
  <ul>
    <li><?php echo $this->Html->link('Home', array('controller'=>'pages', 'action'=>'index'))?></li>
    <li><?php echo $this->Html->link('Users', array('controller'=>'users', 'action'=>'index'))?></li>
    <?php if ($logged_in): ?>
    <li>
      <?php echo $this->Html->link('Friends', array('controller'=>'users', 'action'=>'friends'))?>
      <ul>
        <li><?php echo $this->Html->link('All Friends', array('controller'=>'users', 'action'=>'friends'))?></li>
        <li><?php echo $this->Html->link('Friend Requests', array('controller'=>'users', 'action'=>'friend_requests'))?></li>
      </ul>
    </li>
    <li>
      <?php echo $this->Html->link('Account', array('controller'=>'users', 'action'=>'account'))?>
      <ul>
        <li><?php echo $this->Html->link('Edit Account', array('controller'=>'users', 'action'=>'account'))?></li>
        <li><?php echo $this->Html->link('View Profile', array('controller'=>'users', 'action'=>'view', $current_user['User']['id']))?></li>
        <li><?php echo $this->Html->link('Avatar', array('controller'=>'avatars', 'action'=>'add'))?></li>
      </ul>
    </li> 
    <li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'))?></li>        
    <?php endif; ?>
  </ul>
</div><!-- end main-nav -->