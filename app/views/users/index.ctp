<div id="search-users">
	<h2>Search Members</h2>
	<?php echo $this->Form->create('User'); ?>
		<p><?php echo $this->Form->input('search_name', array('div'=>FALSE, 'label'=>'Name')); ?></p>
		 <p><?php echo $this->Form->input('search_gender', array('div'=>FALSE, 'label'=>'Gender', 'options'=>array(''=>'', 'Male'=>'Male', 'Female'=>'Female'))); ?></p>
		 <p><?php echo $this->Form->input('search_state', array('div'=>FALSE, 'maxlength'=>2, 'class'=>'state', 'label'=>'State')); ?></p>
	<p>
	<?php
		echo $this->Form->submit('Search', array('class'=>'button'));
	?>
	</p>
</div>
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
		<?php if($user['User']['looking_for']): ?>
			(Looking For: <?php echo $user['User']['looking_for']; ?>)
		<?php endif; ?>
		<?php if ($user['User']['gender']): ?>
			- <?php echo $user['User']['gender']; ?> 
		<?php endif; ?>
		<?php if ($user['User']['age']): ?>
				<?php echo $user['User']['age']; ?> years old
		<?php endif; ?>
		<?php if ($user['User']['country']): ?>
			 from <?php echo $user['User']['country']; ?>
		<?php endif; ?>
		</p>
	
	<p class="description">
	<?php if ($user['User']['desc']): ?>
		<?php echo $this->Text->truncate($user['User']['desc'], 80); ?>
	<?php else: ?>
		This user hasn't described themselves yet.
	<?php endif; ?>
	</p>
	
	<p>
		<?php // For not subscribed people show a chirp link
		if ($this->Friend->user_not_subscribed($user['User']['id'])): ?>
			<?php echo $this->Html->link('Send Chirp', array('controller'=>'chirps', 'action'=>'chirp', $user['User']['id'])); ?> | 
		<?php else: ?>
			<?php if ($this->Friend->not_friend_or_self($user['User']['id'])):?>
				<?php echo $this->Html->link('Request Friend', array('controller'=>'users', 'action'=>'send_friend_request', $user['User']['id'])); ?> |
			<?php else:?>
				<?php echo $this->Html->link('Send Message', array('controller'=>'messages', 'action'=>'send', $user['User']['id'])); ?> |
			<?php endif; ?>
		<?php endif; ?>
		<?php echo $this->Html->link('View Profile', array('controller'=>'users', 'action'=>'view', $user['User']['id'])); ?>
		<?php if ($is_admin): ?>
			| <?php echo $this->Html->link('Delete User', array('controller'=>'users', 'action'=>'delete', $user['User']['id']), NULL, 'Are you sure you want to delete this user?'); ?>
		<?php endif; ?>
</div> 
<?php endforeach; ?>


<div class="pagination">
<?php echo $this->Paginator->numbers(array('separator'=>' ')); ?> 
<?php echo $this->Paginator->prev('<- Previous', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->next('Next ->', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->counter(); ?>
</div>
