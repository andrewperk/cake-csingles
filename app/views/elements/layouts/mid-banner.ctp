<div id="mid-banner">
  <?php echo $this->Html->image('mid-banner-couple.jpg'); ?>
	<div id="signup-process">
		<ol>
			<li><p><span>1</span> Register<small>(Free)</small></p></li>
			<li><p><span>2</span> Add Profile<small>(Free)</small></p></li>
			<li><p><span>3</span> Search<small>(Free)</small></p></li>
			<li><p><span>4</span> Contact</p></li>
		</ol>
	</div>
  <p id="register-button">
    <?php echo $this->Html->link('Register Now', array('controller'=>'users', 'action'=>'add'))?>
  </p>
</div><!-- mid-banner -->