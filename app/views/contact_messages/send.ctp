<div id="contact-message">
<h1>Contact Canary Singles</h1>

<?php echo $this->Form->create('ContactMessage', array('action'=>'send')); ?>
<p>
	<?php echo $this->Form->input('name', array('div'=>FALSE)); ?>
</p>
<p>
	<?php echo $this->Form->input('email', array('div'=>FALSE)); ?>
</p>
<p>
	<?php echo $this->Form->input('subject', array('div'=>FALSE)); ?>
</p>
<p>
	<?php echo $this->Form->input('body', array('div'=>FALSE, 'label'=>'Message')); ?>
</p>
<p>
	<?php echo $this->Form->submit('Send', array('div'=>FALSE, 'class'=>'button')); ?>
</p>
<?php echo $this->Form->end(); ?>
</div>
