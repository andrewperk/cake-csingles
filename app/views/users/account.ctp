<h2>
  <?php echo ucfirst($user['User']['username']); ?> 
  <small>
    <?php echo $this->Html->link('(View Your Profile)', array('action'=>'view', $user['User']['id'])); ?>
  </small>
</h2>

<?php echo $this->Form->create('User', array('action'=>'account')); ?>
<div id="personal-info">
  <fieldset>
    <legend>Edit Personal Information</legend>
    <p>Note: You must enter a password and confirm it to approve your changes.</p><br />
    <p><?php echo $this->Form->input('firstname', array('div'=>FALSE)); ?></p>
    <p><?php echo $this->Form->input('lastname', array('div'=>FALSE)); ?></p>
    <p><?php echo $this->Form->input('email', array('div'=>FALSE)); ?></p>
    <p><?php echo $this->Form->input('password', array('div'=>FALSE)); ?></p>
    <p><?php echo $this->Form->input('password_confirmation', array('div'=>FALSE, 'type'=>'password')); ?></p>
  </fieldset>
</div>
<div id="profile-info">
  <fieldset>
    <legend>Profile Information</legend>
    <p><?php echo $this->Form->input('state', array('div'=>FALSE, 'maxlength'=>2, 'class'=>'state')); ?></p>
    <p><?php echo $this->Form->input('gender', array('div'=>FALSE, 'options'=>array('male'=>'male', 'female'=>'female'))); ?></p>
    <p><?php echo $this->Form->input('age', array('div'=>FALSE)); ?></p>
    <p><?php echo $this->Form->input('health_cond', array('div'=>FALSE, 'label'=>'Health Conditions')); ?></p>
    <p><?php echo $this->Form->input('sensitivity_level', array('div'=>FALSE, 'options'=>array('Severe'=>'Severe', 'Moderate'=>'Moderate', 'Mild'=>'Mild'))); ?></p>
    <p><?php echo $this->Form->input('desc', array('div'=>FALSE, 'label'=>'Describe Yourself')); ?></p>
    <p><?php echo $this->Form->input('interests', array('div'=>FALSE)); ?></p>
  </fieldset>
</div>
<p><?php echo $this->Form->submit('Update', array('div'=>FALSE, 'class'=>'button')); ?></p>
<?php echo $this->Form->end(); ?>