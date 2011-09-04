<h1>Add Your Avatar</h1>
<?php echo $this->Form->create('Avatar', array('action'=>'add', 'type'=>'file'))?>
<div id="add-avatar">
  <h2>Upload Picture</h2>
  <?php echo $this->Form->input('avatar', array('div'=>FALSE, 'type'=>'file')); ?>
</div>
<p><?php echo $this->Form->submit('Upload', array('class'=>'button', 'div'=>FALSE)); ?></p>
<?php echo $this->Form->end()?>