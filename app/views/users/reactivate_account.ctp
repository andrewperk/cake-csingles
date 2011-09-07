<div id="reactivate-account">
	<h1>Reactivate Account?</h1>
	<?php echo $this->Form->create('User', array('action'=>'reactivate_account')); ?>
		<p>
			<span class="help">
				(If you previously cancelled your premium membership through your Paypal account when you deactivated your account you will need to upgrade to premium 
				membership again.)
			</span>
			<?php echo $this->Form->input('reactivate', array('div'=>FALSE, 'label'=>FALSE, 'type'=>'hidden', 'value'=>'reactivate')); ?>
		</p>
		<p><?php echo $this->Form->submit('Reactivate', array('div'=>FALSE, 'class'=>'button')); ?> <?php echo $this->Html->link('cancel', array('action'=>'account')); ?></p>
	<?php echo $this->Form->end(); ?>
</div>