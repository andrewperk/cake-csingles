<div id="message">
<h1><?php echo ucfirst($message['User']['username']); ?> says:</h1>
<p>
  <span class="message-header">
    <?php echo $message['Message']['subject']; ?>
  </span>
  <span class="message-preview">
    <?php echo $message['Message']['body']; ?>
  </span>
</p>
</div>