<div id="profile-header">
<p class="float-left">
<?php if ($user['Avatar']['avatar']): ?>
  <?php echo $this->Html->image('avatars/small/' . $user['Avatar']['avatar']); ?>
<?php else: ?>
  <?php echo $this->Html->image('avatar.gif'); ?>
<?php endif; ?>
</p>
<?php if ($this->Friend->not_friend_or_self($user['User']['id']) && $logged_in): ?>
<p><?php echo $this->Html->link('Request Friend', array('action'=>'send_friend_request', $user['User']['id'])); ?></p>
<?php endif; ?>
<h2><?php echo ucfirst($user['User']['username']); ?>'s Profile</h2>
</div>

<div class="profile">
  <h6>Basic Information</h6>
  <table class="info">
    <tr>
      <td class="label">Name: </td><td><?php echo $user['User']['firstname']; ?> <?php echo $user['User']['lastname']; ?></td>
    </tr>
    <tr>
      <td class="label">Gender: </td>
      <td>
        <?php if($user['User']['gender']): ?>
        <?php echo $user['User']['gender']; ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">Age: </td>
      <td>
        <?php if($user['User']['age']): ?>
        <?php echo $user['User']['age']; ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">State: </td>
      <td>
        <?php if($user['User']['state']): ?>
        <?php echo strtoupper($user['User']['state']); ?>
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
        <?php echo $user['User']['desc']; ?>
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
        <?php echo $user['User']['interests']; ?>
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
        <?php echo $user['User']['health_cond']; ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="label">Sensitivity Level: </td>
      <td>
        <?php if($user['User']['sensitivity_level']): ?>
        <?php echo $user['User']['sensitivity_level']; ?>
        <?php else: ?>
        None
        <?php endif; ?>
      </td>
    </tr>
  </table>
</div>