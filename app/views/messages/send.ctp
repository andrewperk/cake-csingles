<div id="send-message">
  <h1>Send Message</h1>
<?php echo $this->Form->create('Message', array('action'=>'send')); ?>
<p><?php echo $this->Form->input('friend_id', array('type'=>'hidden', 'value'=>$friend_id)); ?></p>
<p><?php echo $this->Form->input('subject', array('div'=>FALSE)); ?></p>
<div id="yui-texteditor">
<p><?php echo $this->Form->input('body', array('div'=>FALSE));  ?></p>
</div>
</div>
<?php
echo $this->Form->submit('Send', array('class'=>'button', 'div'=>FALSE, 'id'=>'submitButton'));
echo $this->Form->end();
?>
<?php echo $this->element('rte'); ?>
