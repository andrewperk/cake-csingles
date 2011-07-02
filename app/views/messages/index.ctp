<h1>Your Messages</h1>
<?php if (empty($messages)): ?>
  <p>No messages.</p>
<?php else: ?>
<div id="messages">
  <?php foreach($messages as $message): ?>
    <p>
      <span id="avatar">
        <?php if (!empty($message['User']['Avatar']['avatar'])): ?>
          <?php echo $this->Html->image('avatars/small/' . $message['User']['Avatar']['avatar']); ?>
        <?php else: ?>
          <?php echo $this->Html->image('avatar.gif'); ?>
        <?php endif; ?>  
      </span>
      <span class="message-header">
        <?php echo ucfirst($message['User']['username']); ?>: 
        <?php echo $message['Message']['subject']; ?>
      </span>
      <span class="message-preview">
         <?php echo $this->Text->truncate($message['Message']['body'], 75); ?>
         <?php echo $this->Html->link('Read More', array('action'=>'view', $message['Message']['id'])); ?>
      </span>
    </p>
  <?php endforeach; ?>
</div>
<?php endif; ?>