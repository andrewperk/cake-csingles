<fieldset id="search-users">
	<legend>Search Users</legend>
	<?php echo $this->Form->create('User'); ?>
		<p><?php echo $this->Form->input('search_name', array('div'=>FALSE, 'label'=>'Name')); ?>
		 <?php echo $this->Form->input('search_gender', array('div'=>FALSE, 'label'=>'Gender', 'options'=>array(''=>'', 'Male'=>'Male', 'Female'=>'Female'))); ?>
		 <?php echo $this->Form->input('search_state', array('div'=>FALSE, 'maxlength'=>2, 'class'=>'state', 'label'=>'State')); ?></p>
	<?php
		echo $this->Form->submit('Submit', array('class'=>'button'));
	?>
</fieldset>
<?php echo $this->Form->end(); ?>

<div class="pagination">
<?php echo $this->Paginator->numbers(array('separator'=>' ')); ?> 
<?php echo $this->Paginator->prev('<- Previous', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->next('Next ->', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->counter(); ?> 
</div>


<?php foreach($users as $user): ?>  
<div class="user">
	<p class="avatar">
	<?php if ($user['Avatar']['avatar']): ?>
  	<?php echo $this->Html->image('avatars/small/' . $user['Avatar']['avatar']); ?>
	<?php else: ?>
  	<?php echo $this->Html->image('avatar.gif'); ?>
	<?php endif; ?>
	</p>
	
	<p class="headline">
	<?php if ($user['User']['headline']): ?>
		<?php echo $this->Text->truncate($user['User']['headline'], 100); ?>
	<?php else: ?>
		This user hasn't created a headline.
	<?php endif; ?>
	</p>
	
	<p class="username"><?php echo $this->Html->link($user['User']['username'], array('action'=>'view', $user['User']['id'])); ?> 
		<?php if ($user['User']['gender']): ?>
			- <?php echo $user['User']['gender']; ?> 
			<?php if ($user['User']['age']): ?>
				<?php echo $user['User']['age']; ?> years old.
			<?php endif; ?>
		<?php endif; ?>
		</p>
	
	<p class="description">
	<?php if ($user['User']['desc']): ?>
		<?php echo $this->Text->truncate($user['User']['desc'], 180); ?>
	<?php else: ?>
		This user hasn't described themselves yet.
	<?php endif; ?>
	</p>
	
	<p><?php echo $this->Html->link('Send Message', array('controller'=>'messages', 'action'=>'send', $user['User']['id'])); ?> | 
	<?php echo $this->Html->link('Send Chirp', array('controller'=>'messages', 'action'=>'chirp', $user['User']['id'])); ?>
</div> 
<?php endforeach; ?>


<div class="pagination">
<?php echo $this->Paginator->numbers(array('separator'=>' ')); ?> 
<?php echo $this->Paginator->prev('<- Previous', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->next('Next ->', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->counter(); ?>
</div>