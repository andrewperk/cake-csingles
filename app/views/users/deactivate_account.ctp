<fieldset>
	<legend>Deactivate Account?</legend>
	<?php echo $this->Form->create('User', array('action'=>'deactivate_account')); ?>
		<p>
			<span class="help">
				(Deactivating your account does not stop automatic billing if you have a premium paid membership. If you do have a 
				premium paid membership you will need to cancel this inside of your Paypal Account as well.)
			</span>
			<?php echo $this->Form->input('deactivate', array('div'=>FALSE, 'label'=>FALSE, 'type'=>'hidden', 'value'=>'deactivate')); ?>
		</p>
		<p><?php echo $this->Form->submit('Deactivate', array('div'=>FALSE, 'class'=>'button')); ?> <?php echo $this->Html->link('cancel', array('action'=>'account')); ?></p>
	<?php echo $this->Form->end(); ?>
</fieldset>