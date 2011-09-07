<h1>
  <?php echo ucfirst($user['User']['username']); ?> 
  <small id="profile-link">
    <?php echo $this->Html->link('(View Your Profile)', array('action'=>'view', $user['User']['id'])); ?>
  </small>
</h1>

<div class="important_note">
	<p>Do not include email addresses or phone numbers in your Profile Information(ex. description etc.). They will be removed. 
			If you violate this rule repeatedly, your membership will be cancelled.</p>

	<p>If you want to share your phone number or email address, this should be done through the messages system, 
	which is available only after upgrading to a premium membership.</p>
</div>

<?php echo $this->Form->create('User', array('action'=>'account')); ?>
<div id="personal-info">
    <h2>Edit Personal Info</h2>
    <p>Note: You must enter a password and confirm it to approve your changes.</p><br />
    <p><?php echo $this->Form->input('firstname', array('div'=>FALSE, 'label'=>'First Name')); ?></p>
    <p><?php echo $this->Form->input('lastname', array('div'=>FALSE, 'label'=>'Last Name')); ?></p>
    <p>
    	<?php echo $this->Form->label('email'); ?>
    	<span class="help">
    	(Not publicly displayed.)
    	</span>
    	<?php echo $this->Form->text('email', array('div'=>FALSE)); ?>
  	</p>
    <p><?php echo $this->Form->input('password', array('div'=>FALSE)); ?></p>
    <p><?php echo $this->Form->input('password_confirmation', array('div'=>FALSE, 'type'=>'password')); ?></p>
</div>
<div id="profile-info">
    <h2>Profile Information</h2>
    <p>
    	<?php echo $this->Form->label('headline', 'Headline'); ?>
    	<span class="help">(Ex: Free spirited canary seeks partner to soar.)</span>
    	<?php echo $this->Form->text('headline', array('div'=>FALSE)); ?>
    	</p>
    <p>
    	<?php echo $this->Form->label('desc', 'Describe Yourself'); ?>
    	<span class="help">(What you are seeking from a relationship? What is important and acceptable to you? What type of 
    	personality, appearance and outlook on life do you prefer? Where would you prefer they live? 
    	What about values, morals and intellect? Children? Are your children grown? What interests, 
    	hobbies, life goals do you want to share? Are you willing to relocate? What is completely unacceptable to you? 
    	Are you looking for friends, romance, nesting etc.)</span>
    	<?php echo $this->Form->textarea('desc', array('div'=>FALSE, 'rows'=>'6', 'cols'=>'30')); ?>
    </p>
    <p>
    	<?php echo $this->Form->label('interests'); ?>
    	<span class="help">
    	(Examples: nature, music, meditation, yoga, organic gardening, reading, watching movies, daily walks, 
    	current events, Internet/computers, sports, birdwatching, writing, politics, intellectual conversation, 
    	nutrition, alternative health, cooking, arts, etc.)
    	</span>
    	<?php echo $this->Form->textarea('interests', array('div'=>FALSE, 'cols'=>'30', 'rows'=>'6')); ?>
  	</p>
  	<p>
  		<?php echo $this->Form->input('looking_for', array('div'=>FALSE, 
  			'options'=>array('Friendship'=>'Friendship',
  											 'Activity Partner'=>'Activity Partner',
  											 'Email or Pen Pal'=>'Email or Pen Pal',
  											 'Romance'=>'Romance',
  											 'Casual Dating'=>'Casual Dating',
  											 'Long-Term Relationship'=>'Long-Term Relationship',
  											 'Marriage'=>'Marriage'))); ?>
  	</p>
    <p>
    	<?php echo $this->Form->label('health_cond', 'Health Conditions'); ?>
    	<span class="help">
    	(MCS, EMF, Gulf War Syndrome, Autism, Chronic Fatigue, Fibromyalgia etc)
   		</span>
    	<?php echo $this->Form->textarea('health_cond', array('div'=>FALSE, 'rows'=>'6', 'cols'=>'30')); ?>
  	</p>
    <p><?php echo $this->Form->input('sensitivity_level', array('div'=>FALSE, 'options'=>array('Severe'=>'Severe', 'Moderate'=>'Moderate', 'Mild'=>'Mild'))); ?></p>
    <p><?php echo $this->Form->input('state', array('div'=>FALSE, 'maxlength'=>2, 'class'=>'state')); ?></p>
    <p><?php echo $this->Form->input('gender', array('div'=>FALSE, 'options'=>array('male'=>'male', 'female'=>'female'))); ?></p>
    <p><?php echo $this->Form->input('age', array('div'=>FALSE)); ?></p>
</div>
<p><?php echo $this->Form->submit('Update', array('div'=>FALSE, 'class'=>'button')); ?></p>
<?php echo $this->Form->end(); ?>
