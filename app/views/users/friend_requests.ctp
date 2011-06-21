<h2>Friend Requests From:</h2>
<?php if (empty($requests)): ?>
  <p>None</p>
<?php else: ?>
<ul>
<?php foreach($requests as $request): ?>
  <li>
    <?php echo $this->Html->link($request['User']['username'], array('action'=>'view', $request['User']['id'])); ?> - 
    <?php echo $this->Html->link('Accept', array('action'=>'accept_friend_request', $request['User']['id'])); ?>
  </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>