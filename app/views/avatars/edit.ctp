<h1>Edit Your Avatar</h1>
<?php echo $this->Form->create('Avatar', array('action'=>'edit', 'type'=>'file'))?>
<div id="edit-avatar">
  <h2>Change Picture</h2>
  <p>Your current image:</p><br />
  <p class="float-left"><?php echo $this->Html->image('avatars/small/' . $avatar['Avatar']['avatar']); ?></p><br />
  <p><?php echo $this->Form->input('avatar', array('div'=>FALSE, 'type'=>'file')); ?></p>
</div>
<p><?php echo $this->Form->submit('Upload', array('class'=>'button', 'div'=>FALSE)); ?></p>
<?php echo $this->Form->end()?>