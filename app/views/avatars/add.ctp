<h1>Add Your Photo</h1>
<?php echo $this->Form->create('Avatar', array('action'=>'add', 'type'=>'file'))?>
<div id="add-avatar">
  <h2>Upload Photo</h2>
  <?php echo $this->Form->input('avatar', array('div'=>FALSE, 'type'=>'file', 'label'=>'Choose Your Photo')); ?>
  <span>(Photo must be smaller than 2000px)</span>
</div>
<p><?php echo $this->Form->submit('Upload', array('class'=>'button', 'div'=>FALSE)); ?></p>
<?php echo $this->Form->end()?>

