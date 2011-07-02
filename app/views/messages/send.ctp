<fieldset>
  <legend>Send Message</legend>
<?php
echo $this->Form->create('Message', array('action'=>'send'));
echo $this->Form->input('friend_id', array('type'=>'hidden', 'value'=>$friend_id));
echo $this->Form->input('subject', array('div'=>FALSE));
echo $this->Form->input('body', array('div'=>FALSE));
?>
</fieldset>
<?php
echo $this->Form->submit('Send', array('class'=>'button', 'div'=>FALSE));
echo $this->Form->end();
?>