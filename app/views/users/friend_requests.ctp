<h2>Friend Requests From:</h2>
<?php if (empty($requests)): ?>
  <p>None</p>
<?php else: ?>
<ul id="friends">
<?php foreach($requests as $request): ?>
  <li>
  	<?php if ($request['Avatar']['avatar']): ?>
    	<?php echo $this->Html->image('avatars/small/' . $request['Avatar']['avatar']); ?>
  	<?php else: ?>
    	<?php echo $this->Html->image('avatar.gif'); ?>
  	<?php endif; ?>
  	<div>
	    <?php echo $this->Html->link($request['User']['username'], array('action'=>'view', $request['User']['id'])); ?> - 
	    <?php echo $this->Html->link('Accept', array('action'=>'accept_friend_request', $request['User']['id'])); ?>
    </div>
  </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>