<div id="search-users">
	<h2>Search Members</h2>
	<p>You can search by name/username, gender, country, or state. You can search with just one field or use as many as you'd like.</p>
	<?php echo $this->Form->create('User', array('url'=>array_merge(array('action'=>'index'), $this->params['pass']))); ?>
		<p class="float-left"><?php echo $this->Form->input('search_name', array('div'=>FALSE, 'label'=>'Name')); ?></p>
		 <p><?php echo $this->Form->input('search_gender', array('div'=>FALSE, 'label'=>'Gender', 'options'=>array(''=>'', 'Male'=>'Male', 'Female'=>'Female'))); ?></p>
		 <br />
		 <p class="float-left">
  			<?php echo $this->Form->input('search_country', array('div'=>FALSE, 'label'=>'Country',
  				'options'=>array(''=>'',
  								 'States'=>'United States',
								 'Australia'=>'Australia',
								 'Canada'=>'Canada',
								 'China'=>'China',
								 'France'=>'France',
								 'Germany'=>'Germany',
								 'Italy'=>'Italy',
								 'Japan'=>'Japan',
								 'Mexico'=>'Mexico',
								 'Spain'=>'Spain',
								 'Kingdom'=>'United Kingdom'))); ?>
  		</p>
		 <p><?php echo $this->Form->input('search_state', array('div'=>FALSE, 'maxlength'=>2, 'class'=>'state', 'label'=>'State')); ?></p>

		 <?php //if($is_admin): ?>
		 	<p><?php //echo $this->Form->input('search_email', array('div'=>FALSE)); ?></p><br />
		<?php //endif; ?>
		
	<p class="button">
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
	<?php if (h($user['User']['headline'])): ?>
		<?php echo $this->Text->truncate(h($user['User']['headline']), 100); ?>
	<?php else: ?>
		This user hasn't created a headline.
	<?php endif; ?>
	</p>
	
	<p class="username"><?php echo $this->Html->link(h($user['User']['username']), array('action'=>'view', $user['User']['id'])); ?> 
		<?php if($user['User']['looking_for']): ?>
			(Looking For: <?php echo h($user['User']['looking_for']); ?>)
		<?php endif; ?>
		<?php if ($user['User']['gender']): ?>
			- <?php echo h($user['User']['gender']); ?> 
		<?php endif; ?>
		<?php if ($user['User']['age']): ?>
				<?php echo h($user['User']['age']); ?> years old
		<?php endif; ?>
		<?php if ($user['User']['country']): ?>
			 from <?php echo h($user['User']['country']); ?>
		<?php endif; ?>
		</p>
	
	<p class="description">
	<?php if ($user['User']['desc']): ?>
		<?php echo $this->Text->truncate($this->Hpurifier->purify($user['User']['desc']), 80); ?>
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
				<?php echo $this->Html->link('Request Friend', array('controller'=>'users', 'action'=>'send_friend_request', $user['User']['id']), null, 'Are you sure you want to send '.h($user['User']['username']).' a friend request?'); ?> |
			<?php else:?>
				<?php echo $this->Html->link('Send Message', array('controller'=>'messages', 'action'=>'send', $user['User']['id'])); ?> |
			<?php endif; ?>
		<?php endif; ?>
		<?php echo $this->Html->link('View Profile', array('controller'=>'users', 'action'=>'view', $user['User']['id'])); ?>
		<?php if ($is_admin): ?>
			| <?php echo $this->Html->link('Delete User', array('controller'=>'users', 'action'=>'delete', $user['User']['id']), NULL, 'Are you sure you want to delete this user?'); ?>
			| <?php if($user['User']['subscribed'] == "yes"): ?>
				<?php echo $this->Html->link('Downgrade ('.$user['User']['email'].')', array('controller'=>'users', 'action'=>'downgrade_member', $user['User']['id'])); ?>
			  <?php else: ?>
			  	<?php echo $this->Html->link('Upgrade ('.$user['User']['email'].')', array('controller'=>'users', 'action'=>'upgrade_member', $user['User']['id'])); ?>
			  <?php endif; ?>
		<?php endif; ?>
</div> 
<?php endforeach; ?>


<div class="pagination">
<?php echo $this->Paginator->numbers(array('separator'=>' ')); ?> 
<?php echo $this->Paginator->prev('<- Previous', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->next('Next ->', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->counter(); ?>
</div>
