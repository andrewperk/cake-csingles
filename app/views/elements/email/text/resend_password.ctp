Hi <?php echo h($user['username']); ?>,

You recently requested your username be sent to you along with resetting your password.

You can now log in using your username below and your newly created password. Keep in mind that you can 
always change your password in your account after you log back in.

username: <?php echo h($user['username']); ?>

password: <?php echo $user['newPassword']; ?>