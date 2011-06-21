<?php echo $this->Form->create('Avatar', array('action'=>'edit', 'type'=>'file'))?>
<fieldset>
  <legend>Change Picture</legend>
  <p>Your current image:</p><br />
  <p class="float-left"><?php echo $this->Html->image('avatars/small/' . $avatar['Avatar']['avatar']); ?></p><br />
  <p><?php echo $this->Form->input('avatar', array('div'=>FALSE, 'type'=>'file')); ?></p>
</fieldset>
<p><?php echo $this->Form->submit('Upload', array('class'=>'button', 'div'=>FALSE)); ?></p>
<?php echo $this->Form->end()?>