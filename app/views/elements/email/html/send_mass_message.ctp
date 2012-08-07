<p>Hello <?php echo h($user['username']); ?>,</p>

<?php echo $this->Hpurifier->purify($user['message']); ?>
