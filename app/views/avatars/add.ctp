<?php echo $this->Form->create('Avatar', array('action'=>'add', 'type'=>'file'))?>
<fieldset>
  <legend>Upload Picture</legend>
  <?php echo $this->Form->input('avatar', array('div'=>FALSE, 'type'=>'file')); ?>
</fieldset>
<p><?php echo $this->Form->submit('Upload', array('class'=>'button', 'div'=>FALSE)); ?></p>
<?php echo $this->Form->end()?>