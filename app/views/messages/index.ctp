<h1>Your Messages</h1>
<?php if (empty($messages)): ?>
  <p>No messages.</p>
<?php else: ?>
<div id="messages">
  <?php foreach($messages as $message): ?>
  <div class="user-message">
    <p class="avatar">
      <?php if (!empty($message['User']['Avatar']['avatar'])): ?>
        <?php echo $this->Html->image('avatars/small/' . $message['User']['Avatar']['avatar']); ?>
      <?php else: ?>
        <?php echo $this->Html->image('avatar.gif'); ?>
      <?php endif; ?>  
    </p>
    <div class="message-intro">
      <p><?php echo ucfirst(h($message['User']['username'])); ?>: 
      <?php echo h($message['Message']['subject']); ?></p>
      <p><?php echo $this->Html->link('Read More', array('action'=>'view', $message['Message']['id'])); ?></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>