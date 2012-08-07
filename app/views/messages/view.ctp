<h1><?php echo ucfirst(h($message['User']['username'])); ?> says:</h1>
<div class="user-message">
  <h4>
    <?php echo h($message['Message']['subject']); ?>
  </h4>
  <div id="message-body">
      <?php echo $this->Hpurifier->purify($message['Message']['body']); ?>
  </div>
</div>
<p class="reply-link"><?php echo $this->Html->link('Reply', array('action'=>'reply', $message['Message']['id'], $message['User']['id'])); ?></p>
