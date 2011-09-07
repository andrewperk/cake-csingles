<h1>Send Chirp To <?php echo $user['User']['username']; ?></h1>

<p>Unfortunately <?php echo $user['User']['username']; ?> is not a premium member. Contact can only happen between premium members. You can still 
	let <?php echo $user['User']['username']; ?> know that you would like to make contact though by sending a chirp.</p>
	
<?php echo $this->Form->create('Chirp'); ?>
<?php echo $this->Form->hidden('user_id', array('value'=>$current_user['User']['id'])); ?>
<?php echo $this->Form->hidden('friend_id', array('value'=>$user['User']['id'])); ?>
<?php echo $this->Form->submit('Send Chirp', array('div'=>FALSE, 'class'=>'button')); ?>
<?php echo $this->Form->end(); ?>
