<h1>Your Recently Received Chirps</h1>
<?php if (empty($chirps)): ?>
	<p>No chirps.</p>
<?php endif; ?>
<?php foreach($chirps as $chirp): ?>
	<p class="chirp">
		<?php echo $this->Html->image('chirp.jpg', array('alt'=>$chirp['User']['username'] . " has sent you a chirp.")); ?> 
		<?php echo $this->Html->link($chirp['User']['username'], array('controller'=>'users', 'action'=>'view', $chirp['User']['id'])); ?>
	</p>
<?php endforeach; ?>
