<h2>Your Friends:</h2>
<ul id="friends">
<?php if (empty($friends)): ?>
  <li>None</li>
<?php else: ?>
<?php foreach($friends as $friend): ?>
  <li>    
  <?php if ($friend[0]['Avatar']['avatar']): ?>
    <?php echo $this->Html->image('avatars/small/' . $friend[0]['Avatar']['avatar']); ?>
  <?php else: ?>
    <?php echo $this->Html->image('avatar.gif'); ?>
  <?php endif; ?>  
  <div><?php echo $this->Html->link(ucfirst($friend[0]['User']['username']), array('action'=>'view', $friend[0]['User']['id'])); ?></div>
  </li>
<?php endforeach; ?>
<?php endif; ?>
</ul>
  