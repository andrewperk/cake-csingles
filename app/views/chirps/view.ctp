<h1>Your Recently Received Chirps</h1>
<?php if (empty($chirps)): ?>
	<p>No chirps.</p>
<?php endif; ?>
<?php foreach($chirps as $chirp): ?>
	<p>Chirp received from: <?php echo $chirp['User']['username']; ?></p>
<?php endforeach; ?>
