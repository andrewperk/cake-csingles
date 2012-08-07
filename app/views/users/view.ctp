<div id="profile-header">
<p class="float-left">
<?php if ($user['Avatar']['avatar']): ?>
  <?php echo $this->Html->image('avatars/small/' . $user['Avatar']['avatar']); ?>
<?php else: ?>
  <?php echo $this->Html->image('avatar.gif'); ?>
<?php endif; ?>
</p>
<?php if ($this->Friend->not_friend_or_self($user['User']['id']) && $logged_in): ?>
<p><?php echo $this->Html->link('Request Friend', array('action'=>'send_friend_request', $user['User']['id']), null, 'Are you sure you want to send '.h($user['User']['username']).' a friend request?'); ?></p>
<?php endif; ?>
<h2><?php echo ucfirst(h($user['User']['username'])); ?>'s Profile</h2>
</div>

<div class="profile">
  <h6>Basic Information</h6>
  <table class="info">
    <tr>
      <td class="label">Name: </td>
      <td>
      	<?php if($user['User']['firstname']): ?>
      		<?php echo h($user['User']['firstname']); ?> <?php echo h($user['User']['lastname']); ?>
      	<?php else: ?>
      		N/A
      	<?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">Gender: </td>
      <td>
        <?php if($user['User']['gender']): ?>
        <?php echo h($user['User']['gender']); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">Age: </td>
      <td>
        <?php if($user['User']['age']): ?>
        <?php echo h($user['User']['age']); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">Country: </td>
      <td>
        <?php if($user['User']['country']): ?>
        <?php echo h($user['User']['country']); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">State: </td>
      <td>
        <?php if($user['User']['state']): ?>
        <?php echo strtoupper(h($user['User']['state'])); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
  </table>
  
  <h6>Description</h6>
  <table class="description">
    <tr>
      <td class="label">Description: </td>
      <td>
        <?php if($user['User']['desc']): ?>
        <?php echo $this->Hpurifier->purify($user['User']['desc']); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
  </table>
  
  <h6>Looking For</h6>
  <table class="looking_for">
  	<tr>
      <td class="label">I am: </td>
      <td>
        <?php if($user['User']['iam']): ?>
        <?php echo h($user['User']['iam']); ?>
        <?php else: ?>
        seeking canaries
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">Looking For: </td>
      <td>
        <?php if($user['User']['looking_for']): ?>
        <?php echo h($user['User']['looking_for']); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
  </table>
  
  <h6>Interests</h6>
  <table class="interests">
    <tr>
      <td class="label">Interests: </td>
      <td>
        <?php if($user['User']['interests']): ?>
        <?php echo $this->Hpurifier->purify($user['User']['interests']); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
  </table>
  
  <h6>Health Conditions</h6>
  <table class="health_cond">    
    <tr>
      <td class="label">Health Conditions: </td>
      <td>
        <?php if($user['User']['health_cond']): ?>
        <?php echo $this->Hpurifier->purify($user['User']['health_cond']); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">Sensitivity Level: </td>
      <td>
        <?php if($user['User']['sensitivity_level']): ?>
        <?php echo h($user['User']['sensitivity_level']); ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
  </table>
</div>
