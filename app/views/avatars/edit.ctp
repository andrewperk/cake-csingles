<h1>Edit Your Photo</h1>
<?php echo $this->Form->create('Avatar', array('action'=>'edit', 'type'=>'file'))?>
<div id="edit-avatar">
  <h2>Change Photo</h2>
  <p>Your current photo:</p><br />
  <p class="float-left"><?php echo $this->Html->image('avatars/small/' . $avatar['Avatar']['avatar']); ?></p><br />
  <p><?php echo $this->Form->input('avatar', array('div'=>FALSE, 'type'=>'file', 'label'=>'Choose Your Photo')); ?></p>
</div>
<p><?php echo $this->Form->submit('Upload', array('class'=>'button', 'div'=>FALSE)); ?></p>
<?php echo $this->Form->end()?>
