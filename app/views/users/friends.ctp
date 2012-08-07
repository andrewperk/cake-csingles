<h2>Your Friends:</h2>
<ul id="friends">
<?php if (empty($friends)): ?>
  <li>None</li>
<?php else: ?>
<?php foreach($friends as $friend): ?>
	<?php 
	// Display only visible users
	if ($friend[0]['User']['visible']): ?>
  <li>    
  <?php if ($friend[0]['Avatar']['avatar']): ?>
    <?php echo $this->Html->image('avatars/small/' . $friend[0]['Avatar']['avatar']); ?>
  <?php else: ?>
    <?php echo $this->Html->image('avatar.gif'); ?>
  <?php endif; ?>  
  <div>
		<?php echo $this->Html->link(ucfirst(h($friend[0]['User']['username'])), array('action'=>'view', $friend[0]['User']['id'])); ?> | 
  	<?php echo $this->Html->link('Remove Friend', array('action'=>'delete_friend', $friend[0]['User']['id']), NULL, 'Are you sure?'); ?> |
		<?php echo $this->Html->link('Send Message', array('controller'=>'messages', 'action'=>'send', $friend[0]['User']['id'])); ?>
	</div>
  </li>
  <?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
  