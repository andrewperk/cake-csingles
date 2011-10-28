<h1>Send Mass Message to All Users (email only for now)</h1>
<?php if (isset($message_sent)): ?>
	<?php 
	debug($message_sent);
	echo $message_sent['subject'];
	echo $message_sent['message']; 
	?>
<?php endif; ?>
<?php 
echo $this->Form->create(null, array('action'=>'send_mass_message'));
echo $this->Form->input('subject');
echo $this->Form->input('message', array('type'=>'textarea', 'class'=>'ckeditor'));
echo $this->Form->submit('Send Message', array('id'=>'mass_message_submit_button'));
echo $this->Form->end(); 
?>
<?php print_r($users); ?>
<script>
submit = document.getElementById('mass_message_submit_button');
submit.onclick = function() {
	if (confirm('Are you sure you want to send this message as it is?')) {
	} else {
		return false;
	}
};
</script>
