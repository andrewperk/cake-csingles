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
    <p><?php echo $this->Form->input('headline', array('div'=>FALSE, 'label'=>'Headline')); ?></p>
    <p><?php echo $this->Form->input('desc', array('div'=>FALSE, 'label'=>'Describe Yourself')); ?></p>
    <p class="help">(What you are seeking from a relationship? What is important and acceptable to you? What type of 
    	personality, appearance and outlook on life do you prefer? Where would you prefer they live? 
    	What about values, morals and intellect? Children? Are your children grown? What interests, 
    	hobbies, life goals do you want to share? Are you willing to relocate? What is completely unacceptable to you? 
    	Are you looking for friends, romance, nesting etc.)</p>
    <p><?php echo $this->Form->input('interests', array('div'=>FALSE)); ?></p>
    <p class="help">
    	(Examples: nature, music, meditation, yoga, organic gardening, reading, watching movies, daily walks, 
    	current events, Internet/computers, sports, birdwatching, writing, politics, intellectual conversation, 
    	nutrition, alternative health, cooking, arts, etc.)
    </p>
    <p><?php echo $this->Form->input('health_cond', array('div'=>FALSE, 'label'=>'Health Conditions')); ?></p>
    <p class="help">
    	(MCS, EMF, Gulf War Syndrome, Autism, Chronic Fatigue, Fibromyalgia etc)
    </p>
    <p><?php echo $this->Form->input('sensitivity_level', array('div'=>FALSE, 'options'=>array('Severe'=>'Severe', 'Moderate'=>'Moderate', 'Mild'=>'Mild'))); ?></p>
    <p><?php echo $this->Form->input('state', array('div'=>FALSE, 'maxlength'=>2, 'class'=>'state')); ?></p>
    <p><?php echo $this->Form->input('gender', array('div'=>FALSE, 'options'=>array('male'=>'male', 'female'=>'female'))); ?></p>
    <p><?php echo $this->Form->input('age', array('div'=>FALSE)); ?></p>
  </fieldset>
</div>
<p><?php echo $this->Form->submit('Update', array('div'=>FALSE, 'class'=>'button')); ?></p>
<?php echo $this->Form->end(); ?>